<?php

namespace CodelyTv\Shared\Domain\Bus\Event;

use RuntimeException;

interface DomainEventPublisher
{
    /**
     * @throws RuntimeException
     *
     * @return void
     */
    public function register($eventClass, callable $subscriber);

    /**
     * Raises events to be published afterwards
     *
     * @param DomainEvent[] $events
     *
     * @return void
     */
    public function raise(array $domainEvents);

    /**
     * Send events to process
     *
     * @param DomainEvent[] $events
     *
     * @return void
     */
    public function flush();

    /**
     * Raises events to be published afterwards (with flush command)
     *
     * @param DomainEvent[] $events
     *
     * @return void
     */
    public function publish(array $domainEvents);
}
