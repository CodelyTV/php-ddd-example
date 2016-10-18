<?php

namespace CodelyTv\Tests\Infrastructure\Bus\Oracle;

use CodelyTv\Infrastructure\Bus\Query\OracleSync;
use CodelyTv\Infrastructure\Bus\Query\Query;
use CodelyTv\Test\PhpUnit\TestCase\UnitTestCase;
use RuntimeException;

final class OracleSyncTest extends UnitTestCase
{
    /** @var OracleSync */
    private $oracle;
    /** @var Query */
    private $query;

    protected function setUp()
    {
        parent::setUp();

        $this->oracle = new OracleSync();
    }

    /** @test */
    public function it_should_return_a_response_successfully()
    {
        $this->oracle->register(get_class($this->query()), $this->queryHandler());

        $this->shouldCallQueryHandler(5);

        $this->assertEquals(new FakeResponse(25), $this->oracle->ask($this->query));
    }

    /** @test */
    public function it_should_throw_an_exception_registering_a_handler_after_some_ask_has_been_done()
    {
        $this->oracle->register(get_class($this->query()), $this->queryHandler());

        $this->shouldCallQueryHandler(5);

        $this->assertEquals(new FakeResponse(25), $this->oracle->ask($this->query));

        $this->expectException(RuntimeException::class);

        $this->oracle->register(get_class($this->query()), $this->queryHandler());
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
