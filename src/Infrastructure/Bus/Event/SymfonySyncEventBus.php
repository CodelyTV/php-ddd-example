<?php

declare(strict_types = 1);

namespace CodelyTv\Infrastructure\Bus\Event;

use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\CallableFirstParameterExtractor;
use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use Symfony\Component\Messenger\Handler\Locator\HandlerLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use function Lambdish\Phunctional\map;

final class SymfonySyncEventBus implements EventBus
{
    private $bus;

    public function __construct(iterable $subscribers)
    {
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlerLocator(
                        map($this->pipeSubscribers(), CallableFirstParameterExtractor::forPipedCallables($subscribers))
                    )
                ),
            ]
        );
    }

    public function notify(DomainEvent $event): void
    {
        $this->bus->dispatch($event);
    }

    private function pipeSubscribers()
    {
        return function (array $subscribers) {
            return function (DomainEvent $event) use ($subscribers) {
                foreach ($subscribers as $subscriber) {
                    $subscriber($event);
                }
            };
        };
    }
}
