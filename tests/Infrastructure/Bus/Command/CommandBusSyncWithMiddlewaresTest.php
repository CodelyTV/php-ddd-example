<?php

namespace CodelyTv\Test\Infrastructure\Bus\Command;

use CodelyTv\Infrastructure\Bus\Command\CommandBusSync;
use CodelyTv\Infrastructure\Bus\Middleware\MessageLoggerMiddleware;
use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Test\Infrastructure\PHPUnit\UnitTestCase;
use Mockery\MockInterface;
use Psr\Log\LoggerInterface;

final class CommandBusSyncWithMiddlewaresTest extends UnitTestCase
{
    /** @var CommandBusSync */
    private $commandBus;
    private $command;
    private $logger;

    protected function setUp()
    {
        parent::setUp();

        $this->commandBus = new CommandBusSync(new MessageLoggerMiddleware($this->logger()));
    }

    /** @test */
    public function it_should_be_able_to_handle_a_command_with_middlewares()
    {
        $this->commandBus->register(get_class($this->command()), $this->commandHandler());

        $this->shouldCheckCommandMessageType();
        $this->shouldLog();
        $this->commandHandlerShouldBeCalled();

        $this->commandBus->dispatch($this->command());
    }

    /** @return LoggerInterface|MockInterface */
    protected function logger()
    {
        return $this->logger = $this->logger ?: $this->mock(LoggerInterface::class);
    }

    protected function shouldLog()
    {
        $this->logger()->shouldReceive('debug')->once()->andReturnNull();
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

    private function shouldCheckCommandMessageType()
    {
        $this->command()
            ->shouldReceive('messageType')
            ->once()
            ->withNoArgs()
            ->andReturn('command');
    }
}
