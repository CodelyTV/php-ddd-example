<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Bus\Event;

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

    public function publish(DomainEvent ...$domainEvents): void
    {
        $this->record(...$domainEvents);

        $this->publishRecorded();
    }

    public function popPublishedEvents(): array
    {
        $events                = $this->publishedEvents;
        $this->publishedEvents = [];

        return $events;
    }

    public function hasEventsToPublish(): bool
    {
        return count($this->publishedEvents) > 0;
    }

    private function eventPublisher(): callable
    {
        return function (DomainEvent $event): void {
            $this->publishedEvents[] = $event;
        };
    }

    private function popEvents(): array
    {
        $events       = $this->events;
        $this->events = [];

        return $events;
    }
}
