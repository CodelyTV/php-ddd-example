<?php

declare(strict_types = 1);

namespace CodelyTv\Infrastructure\Bus\Event;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use function Lambdish\Phunctional\each;

final class SymfonySyncDomainEventPublisher implements DomainEventPublisher
{
    private $events = [];
    private $publishedEvents = [];

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

    public function popPublishedEvents()
    {
        $events                = $this->publishedEvents;
        $this->publishedEvents = [];

        return $events;
    }

    public function hasEventsToPublish(): bool
    {
        return count($this->publishedEvents) > 0;
    }

    private function eventPublisher()
    {
        return function (DomainEvent $event) {
            $this->publishedEvents[] = $event;
        };
    }

    private function popEvents()
    {
        $events       = $this->events;
        $this->events = [];

        return $events;
    }
}
