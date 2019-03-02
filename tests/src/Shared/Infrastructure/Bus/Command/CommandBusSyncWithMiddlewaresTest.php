<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Bus\Command;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Infrastructure\Bus\Command\SymfonySyncCommandBus;
use CodelyTv\Shared\Infrastructure\Bus\Middleware\MessageLoggerMiddleware;
use CodelyTv\Test\Shared\Infrastructure\PHPUnit\UnitTestCase;
use Mockery\MockInterface;
use Psr\Log\LoggerInterface;

final class CommandBusSyncWithMiddlewaresTest extends UnitTestCase
{
    /** @var SymfonySyncCommandBus */
    private $commandBus;
    private $command;
    private $logger;

    protected function setUp()
    {
        parent::setUp();

        $this->markTestSkipped('Temporally middlewares are disabled');

        $this->commandBus = new SymfonySyncCommandBus(new MessageLoggerMiddleware($this->logger()));
    }

    /** @test */
    public function it_should_be_able_to_handle_a_command_with_middlewares(): void
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

    protected function shouldLog(): void
    {
        $this->logger()->shouldReceive('debug')->once()->andReturnNull();
    }

    private function commandHandler(): callable
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

    private function commandHandlerShouldBeCalled(): void
    {
        $this->command()
            ->shouldReceive('name')
            ->once()
            ->withNoArgs();
    }

    private function shouldCheckCommandMessageType(): void
    {
        $this->command()
            ->shouldReceive('messageType')
            ->once()
            ->withNoArgs()
            ->andReturn('command');
    }
}
