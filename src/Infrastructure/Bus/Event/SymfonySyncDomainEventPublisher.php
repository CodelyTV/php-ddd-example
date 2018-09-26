<?php

declare(strict_types = 1);

namespace CodelyTv\Infrastructure\Bus\Event;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use RuntimeException;
use Symfony\Component\Messenger\Handler\Locator\HandlerLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use function Lambdish\Phunctional\each;
use function Lambdish\Phunctional\map;

final class SymfonySyncDomainEventPublisher implements DomainEventPublisher
{
    private $routerIsAttached = false;
    private $eventToSubscribers = [];
    private $bus;
    private $events = [];

    public function subscribe(string $eventClass, callable $subscriber): void
    {
        $this->guardRouterIsAttached();

        $this->eventToSubscribers[$eventClass][] = $subscriber;
    }

    public function record(DomainEvent ...$domainEvents): void
    {
        $this->events = array_merge($this->events, array_values($domainEvents));
    }

    public function publishRecorded(): void
    {
        $this->attachRouter();

        each($this->eventPublisher(), $this->popEvents());
    }

    public function publish(DomainEvent ...$domainEvents)
    {
        $this->record(...$domainEvents);

        $this->publishRecorded();
    }

    private function guardRouterIsAttached()
    {
        if ($this->routerIsAttached) {
            throw new RuntimeException('Trying to register a new subscriber after some publish has been done');
        }
    }

    private function attachRouter()
    {
        if (!$this->routerIsAttached) {
            $this->routerIsAttached = true;
        }
    }

    private function eventPublisher()
    {
        return function (DomainEvent $event) {
            $this->bus()->dispatch($event);
        };
    }

    private function popEvents()
    {
        $events       = $this->events;
        $this->events = [];

        return $events;
    }

    private function bus(): MessageBus
    {
        return $this->bus = $this->bus ?: new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlerLocator(map($this->pipeSubscribers(), $this->eventToSubscribers))
                ),
            ]
        );
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
