<?php

declare(strict_types=1);

namespace CodelyTv\Infrastructure\Bus\Event;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use Prooph\ServiceBus\EventBus;
use Prooph\ServiceBus\Plugin\Router\EventRouter;
use RuntimeException;
use function Lambdish\Phunctional\each;

final class DomainEventPublisherSync implements DomainEventPublisher
{
    private $bus;
    private $router;
    private $routerIsAttached = false;
    private $events           = [];

    public function __construct()
    {
        $this->bus    = new EventBus();
        $this->router = new EventRouter();
    }

    public function subscribe(string $eventClass, callable $subscriber): void
    {
        $this->guardRouterIsAttached();

        $this->router->route($eventClass)->to($subscriber);
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
            $this->bus->utilize($this->router);

            $this->routerIsAttached = true;
        }
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
}
