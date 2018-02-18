<?php

namespace CodelyTv\Test\Infrastructure\Bus\Event;

use DomainException;
use CodelyTv\Test\Infrastructure\PHPUnit\UnitTestCase;
use CodelyTv\Test\Shared\Domain\UuidStub;
use CodelyTv\Test\Shared\Domain\WordStub;

final class DomainEventTest extends UnitTestCase
{
    /** @test */
    public function it_should_retrieve_the_event_data_as_attributes()
    {
        $aggregateId    = UuidStub::random();
        $someIdentifier = UuidStub::random();
        $event          = new ConstructionTestDomainEvent($aggregateId, ['someIdentifier' => $someIdentifier]);

        $this->assertEquals($aggregateId, $event->aggregateId());
        $this->assertEquals($someIdentifier, $event->someIdentifier());
    }

    /** @test */
    public function it_should_not_throw_an_exception_constructing_an_event_with_more_parameters_than_defined()
    {
        $aggregateId          = UuidStub::random();
        $someIdentifier       = UuidStub::random();
        $nonDeclaredParameter = WordStub::random();

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
    public function it_should_throw_an_exception_constructing_an_event_without_a_required_parameter()
    {
        $this->expectException(DomainException::class);

        new ConstructionTestDomainEvent(UuidStub::random(), []);
    }

    /** @test */
    public function it_should_throw_an_exception_constructing_an_event_having_a_parameter_with_an_incorrect_type()
    {
        $this->expectException(DomainException::class);

        new ConstructionTestDomainEvent(UuidStub::random(), ['someIdentifier' => ['this is an array']]);
    }
}
