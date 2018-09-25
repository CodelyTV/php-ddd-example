<?php

namespace CodelyTv\Test\Infrastructure\Bus\Command;

use CodelyTv\Infrastructure\Bus\Command\SymfonySyncCommandBus;
use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Test\Infrastructure\PHPUnit\UnitTestCase;
use Mockery\MockInterface;
use RuntimeException;

final class CommandBusSyncTest extends UnitTestCase
{
    /** @var SymfonySyncCommandBus */
    private $commandBus;
    private $command;

    protected function setUp()
    {
        parent::setUp();

        $this->commandBus = new SymfonySyncCommandBus();
    }

    /** @test */
    public function it_should_be_able_to_handle_a_command()
    {
        $this->commandBus->register(get_class($this->command()), $this->commandHandler());

        $this->commandHandlerShouldBeCalled();

        $this->commandBus->dispatch($this->command());
    }

    /** @test */
    public function it_should_throw_an_exception_registering_a_handler_after_some_dispath_has_been_done()
    {
        $this->commandBus->register(get_class($this->command()), $this->commandHandler());

        $this->commandHandlerShouldBeCalled();

        $this->commandBus->dispatch($this->command());

        $this->expectException(RuntimeException::class);

        $this->commandBus->register(get_class($this->command()), $this->commandHandler());
    }

    private function commandHandler()
    {
        return function ($command) {
            $command->name();
        };
    }

    /** @return Command|MockInterface */
    private function command()
    {
        return $this->command = $this->command ?: $this->mock(Command::class);
    }

    private function commandHandlerShouldBeCalled()
    {
        $this->command()
            ->shouldReceive('name')
            ->once()
            ->withNoArgs();
    }
}
