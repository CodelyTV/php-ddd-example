<?php

declare(strict_types = 1);

namespace CodelyTv\Infrastructure\Bus\Event;

use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\CallableFirstParameterExtractor;
use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

final class SymfonySyncEventBus implements EventBus
{
    private $bus;

    public function __construct(iterable $subscribers)
    {
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlersLocator(
                        CallableFirstParameterExtractor::forPipedCallables($subscribers)
                    )
                ),
            ]
        );
    }

    public function notify(DomainEvent $event): void
    {
        $this->bus->dispatch($event);
    }
}
