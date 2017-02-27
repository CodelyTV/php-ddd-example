<?php

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

    public function __construct()
    {
        $this->bus    = new EventBus();
        $this->router = new EventRouter();
    }

    public function register($eventClass, callable $subscriber)
    {
        $this->guardRouterIsAttached();

        $this->router->route($eventClass)->to($subscriber);
    }

    public function publish(array $domainEvents)
    {
        $this->attachRouter();

        each($this->eventPublisher(), $domainEvents);
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
}
