<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Infrastructure\Bus\Query;

use CodelyTv\Infrastructure\Bus\Query\QueryNotRegisteredError;
use CodelyTv\Infrastructure\Bus\Query\SymfonySyncQueryBus;
use CodelyTv\Shared\Domain\Bus\Query\Query;
use CodelyTv\Test\Infrastructure\PHPUnit\UnitTestCase;
use RuntimeException;

final class SymfonySyncQueryBusTest extends UnitTestCase
{
    /** @var SymfonySyncQueryBus */
    private $queryBus;

    protected function setUp()
    {
        parent::setUp();

        $this->queryBus = new SymfonySyncQueryBus([$this->queryHandler()]);
    }

    /**
     * @test
     * @expectedException RuntimeException
     */
    public function it_should_return_a_response_successfully()
    {
        $this->queryBus->ask(new FakeQuery());
    }

    /** @test */
    public function it_should_raise_an_exception_dispatching_a_non_registered_query()
    {
        $this->expectException(QueryNotRegisteredError::class);

        $this->queryBus->ask($this->mock(Query::class));
    }

    private function queryHandler()
    {
        return new class
        {
            public function __invoke(FakeQuery $query)
            {
                throw new RuntimeException('This works fine!');
            }
        };
    }
}
