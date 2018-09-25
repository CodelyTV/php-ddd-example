<?php

namespace CodelyTv\Infrastructure\Bus\Command;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use RuntimeException;
use Symfony\Component\Messenger\Handler\Locator\HandlerLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

final class SymfonySyncCommandBus implements CommandBus
{
    private $commandToHandler = [];
    private $bus;
    private $dispatchHasBeenCalled = false;

    public function register($commandClass, callable $handler)
    {
        $this->guardDispatchHasNotBeenCalled();

        $this->commandToHandler[$commandClass] = $handler;
    }

    public function dispatch(Command $command)
    {
        $this->markAsAsked();

        $this->bus()->dispatch($command);
    }

    private function guardDispatchHasNotBeenCalled()
    {
        if ($this->dispatchHasBeenCalled) {
            throw new RuntimeException('Trying to register a new handler after some command has been dispatched');
        }
    }

    private function markAsAsked()
    {
        if (!$this->dispatchHasBeenCalled) {
            $this->dispatchHasBeenCalled = true;
        }
    }

    private function bus(): MessageBus
    {
        return $this->bus = $this->bus ?: new MessageBus(
            [
                new HandleMessageMiddleware(new HandlerLocator($this->commandToHandler)),
            ]
        );
    }
}
