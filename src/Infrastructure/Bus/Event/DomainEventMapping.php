<?php

declare(strict_types = 1);

namespace CodelyTv\Infrastructure\Bus\Event;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use function Lambdish\Phunctional\reduce;
use function Lambdish\Phunctional\reindex;

final class DomainEventMapping
{
    private $mapping = [];

    public function __construct(iterable $mapping)
    {
        $this->mapping = reduce($this->eventsExtractor(), $mapping);
    }

    public function for(string $name)
    {
        return $this->mapping[$name];
    }

    public function all()
    {
        return $this->mapping;
    }

    private function eventsExtractor()
    {
        return function (array $mapping, DomainEventSubscriber $subscriber) {
            return array_merge($mapping, reindex($this->eventNameExtractor(), $subscriber::subscribedTo()));
        };
    }

    private function eventNameExtractor()
    {
        return function (DomainEvent $event) {
            return $event::eventName();
        };
    }
}
