<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Bus\Command;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Infrastructure\Bus\Command\CommandNotRegisteredError;
use CodelyTv\Shared\Infrastructure\Bus\Command\SymfonySyncCommandBus;
use CodelyTv\Test\Shared\Infrastructure\PHPUnit\UnitTestCase;
use RuntimeException;

final class SymfonySyncCommandBusTest extends UnitTestCase
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
    public function it_should_be_able_to_handle_a_command(): void
    {
        $this->commandBus->dispatch(new FakeCommand(Uuid::random()));
    }

    /** @test */
    public function it_should_raise_an_exception_dispatching_a_non_registered_command(): void
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
