<?php

namespace CodelyTv\Test\Infrastructure\Bus\Query;

use CodelyTv\Infrastructure\Bus\Query\QueryBusSync;
use CodelyTv\Shared\Domain\Bus\Query\Query;
use CodelyTv\Test\Infrastructure\PHPUnit\UnitTestCase;
use RuntimeException;

final class QueryBusSyncTest extends UnitTestCase
{
    /** @var QueryBusSync */
    private $queryBus;
    /** @var Query */
    private $query;

    protected function setUp()
    {
        parent::setUp();

        $this->queryBus = new QueryBusSync();
    }

    /** @test */
    public function it_should_return_a_response_successfully()
    {
        $this->queryBus->register(get_class($this->query()), $this->queryHandler());

        $this->shouldCallQueryHandler(5);

        $this->assertEquals(new FakeResponse(25), $this->queryBus->ask($this->query));
    }

    /** @test */
    public function it_should_throw_an_exception_registering_a_handler_after_some_ask_has_been_done()
    {
        $this->queryBus->register(get_class($this->query()), $this->queryHandler());

        $this->shouldCallQueryHandler(5);

        $this->assertEquals(new FakeResponse(25), $this->queryBus->ask($this->query));

        $this->expectException(RuntimeException::class);

        $this->queryBus->register(get_class($this->query()), $this->queryHandler());
    }

    private function query()
    {
        return $this->query = $this->query ?: $this->mock(Query::class);
    }

    private function queryHandler()
    {
        return function ($query) {
            return new FakeResponse($query->quantity() * 5);
        };
    }

    private function shouldCallQueryHandler($queryQuantity)
    {
        $this->query()
            ->shouldReceive('quantity')
            ->once()
            ->withNoArgs()
            ->andReturn($queryQuantity);
    }
}
