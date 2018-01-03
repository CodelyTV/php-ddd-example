<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\Bus\Event;

use RuntimeException;

interface DomainEventPublisher
{
    /**
     * Subscribes a $subscriber function to an specific $eventClass
     *
     * @throws RuntimeException
     */
    public function subscribe(string $eventClass, callable $subscriber): void;

    /**
     * Records events to be published afterwards using the publishRecorded method
     */
    public function record(DomainEvent ...$domainEvents): void;

    /**
     * Publishes previously recorded events
     */
    public function publishRecorded(): void;

    /**
     * Immediately publishes the received events
     */
    public function publish(DomainEvent ...$domainEvents);
}
