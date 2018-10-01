<?php

declare(strict_types = 1);

namespace CodelyTv\Infrastructure\Bus\Event;

use CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler\CallableFirstParameterExtractor;
use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use Symfony\Component\Messenger\Handler\Locator\HandlerLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use function Lambdish\Phunctional\each;
use function Lambdish\Phunctional\map;

final class SymfonySyncDomainEventPublisher implements DomainEventPublisher
{
    private $bus;
    private $events = [];

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

    public function record(DomainEvent ...$domainEvents): void
    {
        $this->events = array_merge($this->events, array_values($domainEvents));
    }

    public function publishRecorded(): void
    {
        each($this->eventPublisher(), $this->popEvents());
    }

    public function publish(DomainEvent ...$domainEvents)
    {
        $this->record(...$domainEvents);

        $this->publishRecorded();
    }

    private function eventPublisher()
    {
        return function (DomainEvent $event) {
            $this->bus->dispatch($event);
        };
    }

    private function popEvents()
    {
        $events       = $this->events;
        $this->events = [];

        return $events;
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
