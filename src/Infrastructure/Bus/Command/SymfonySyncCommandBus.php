<?php

declare(strict_types = 1);

namespace CodelyTv\Infrastructure\Bus\Command;

use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\CallableFirstParameterExtractor;
use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\Locator\HandlerLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

final class SymfonySyncCommandBus implements CommandBus
{
    private $bus;

    public function __construct(iterable $commandHandlers)
    {
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlerLocator(CallableFirstParameterExtractor::forCallables($commandHandlers))
                ),
            ]
        );
    }

    public function dispatch(Command $command): void
    {
        try {
            $this->bus->dispatch($command);
        } catch (NoHandlerForMessageException $unused) {
            throw new CommandNotRegisteredError($command);
        }
    }
}
