<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Shared\Infrastructure\Bus\Event\MySql;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Infrastructure\Bus\Event\DomainEventMapping;
use CodelyTv\Shared\Infrastructure\Bus\Event\MySql\MySqlDoctrineDomainEventsConsumer;
use CodelyTv\Shared\Infrastructure\Bus\Event\MySql\MySqlDoctrineEventBus;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseCreatedDomainEventMother;
use CodelyTv\Tests\Mooc\CoursesCounter\Domain\CoursesCounterIncrementedDomainEventMother;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use Doctrine\ORM\EntityManager;

final class MySqlDoctrineEventBusTest extends InfrastructureTestCase
{
    private $bus;
    private $consumer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bus      = new MySqlDoctrineEventBus($this->service(EntityManager::class));
        $this->consumer = new MySqlDoctrineDomainEventsConsumer(
            $this->service(EntityManager::class),
            $this->service(DomainEventMapping::class)
        );
    }

    /** @test */
    public function it_should_publish_and_consume_domain_events_from_msql(): void
    {
        $domainEvent        = CourseCreatedDomainEventMother::random();
        $anotherDomainEvent = CoursesCounterIncrementedDomainEventMother::random();

        $this->bus->publish($domainEvent, $anotherDomainEvent);

        $this->consumer->consume(
            $this->spySubscriber($domainEvent, $anotherDomainEvent),
            $eventsToConsume = 2
        );
    }

    private function spySubscriber(DomainEvent ...$expectedDomainEvents): callable
    {
        return function (DomainEvent $domainEvent) use ($expectedDomainEvents): void {
            $this->assertContainsEquals($domainEvent, $expectedDomainEvents);
        };
    }
}
