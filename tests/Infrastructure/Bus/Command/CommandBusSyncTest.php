<?php

namespace CodelyTv\Test\Infrastructure\Bus\Command;

use CodelyTv\Infrastructure\Bus\Command\CommandNotRegisteredError;
use CodelyTv\Infrastructure\Bus\Command\SymfonySyncCommandBus;
use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Test\Infrastructure\PHPUnit\UnitTestCase;
use CodelyTv\Types\ValueObject\Uuid;
use RuntimeException;

final class CommandBusSyncTest extends UnitTestCase
{
    /** @var SymfonySyncCommandBus */
    private $commandBus;

    protected function setUp()
    {
        parent::setUp();

        $this->commandBus = new SymfonySyncCommandBus([$this->commandHandler()]);
    }

    /**
     * @test
     * @expectedException RuntimeException
     */
    public function it_should_be_able_to_handle_a_command()
    {
        $this->commandBus->dispatch(new FakeCommand(Uuid::random()));
    }

    /** @test */
    public function it_should_raise_an_exception_dispatching_a_non_registered_command()
    {
        $this->expectException(CommandNotRegisteredError::class);

        $this->commandBus->dispatch($this->mock(Command::class));
    }

    private function commandHandler()
    {
        return new class
        {
            public function __invoke(FakeCommand $command)
            {
                throw new RuntimeException('This works fine!');
            }
        };
    }
}
