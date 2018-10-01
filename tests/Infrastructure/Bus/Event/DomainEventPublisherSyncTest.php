<?php

namespace CodelyTv\Test\Infrastructure\Bus\Event;

use CodelyTv\Infrastructure\Bus\Event\SymfonySyncDomainEventPublisher;
use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use CodelyTv\Test\Infrastructure\PHPUnit\UnitTestCase;

final class DomainEventPublisherSyncTest extends UnitTestCase
{
    public static $totalTimesCalled;
    /** @var SymfonySyncDomainEventPublisher */
    private $publisher;

    protected function setUp()
    {
        parent::setUp();

        self::$totalTimesCalled = 0;
        $this->publisher        = new SymfonySyncDomainEventPublisher(
            [
                $this->subscriber(),
                $this->subscriber(),
            ]
        );
    }

    /** @test */
    public function it_should_publish_and_handle_one_event()
    {
        $this->publisher->publish(new FakeDomainEvent('aggregate id'));

        $this->assertEquals(2, self::$totalTimesCalled);
    }

    private function subscriber()
    {
        return new class() implements DomainEventSubscriber
        {
            public function __invoke(DomainEvent $unused)
            {
                DomainEventPublisherSyncTest::$totalTimesCalled++;
            }

            public static function subscribedTo(): array
            {
                return [FakeDomainEvent::class];
            }
        };
    }
}
