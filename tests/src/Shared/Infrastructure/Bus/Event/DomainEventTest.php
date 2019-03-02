<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Bus\Event;

use CodelyTv\Test\Shared\Domain\UuidMother;
use CodelyTv\Test\Shared\Domain\WordMother;
use CodelyTv\Test\Shared\Infrastructure\PHPUnit\UnitTestCase;
use DomainException;

final class DomainEventTest extends UnitTestCase
{
    /** @test */
    public function it_should_retrieve_the_event_data_as_attributes(): void
    {
        $aggregateId    = UuidMother::random();
        $someIdentifier = UuidMother::random();
        $event          = new ConstructionTestDomainEvent($aggregateId, ['someIdentifier' => $someIdentifier]);

        $this->assertEquals($aggregateId, $event->aggregateId());
        $this->assertEquals($someIdentifier, $event->someIdentifier());
    }

    /** @test */
    public function it_should_not_throw_an_exception_constructing_an_event_with_more_parameters_than_defined(): void
    {
        $aggregateId          = UuidMother::random();
        $someIdentifier       = UuidMother::random();
        $nonDeclaredParameter = WordMother::random();

        $event = new ConstructionTestDomainEvent(
            $aggregateId,
            [
                'someIdentifier'       => $someIdentifier,
                'nonDeclaredParameter' => $nonDeclaredParameter,
            ]
        );

        $this->assertEquals($aggregateId, $event->aggregateId());
        $this->assertEquals($someIdentifier, $event->someIdentifier());
        $this->assertEquals($nonDeclaredParameter, $event->nonDeclaredParameter());
    }

    /** @test */
    public function it_should_throw_an_exception_constructing_an_event_without_a_required_parameter(): void
    {
        $this->expectException(DomainException::class);

        new ConstructionTestDomainEvent(UuidMother::random(), []);
    }

    /** @test */
    public function it_should_throw_an_exception_constructing_an_event_having_a_parameter_with_an_incorrect_type(): void
    {
        $this->expectException(DomainException::class);

        new ConstructionTestDomainEvent(UuidMother::random(), ['someIdentifier' => ['this is an array']]);
    }
}
