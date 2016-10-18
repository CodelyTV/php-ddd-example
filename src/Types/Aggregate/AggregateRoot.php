<?php

namespace CodelyTv\Types\Aggregate;

use CodelyTv\Infrastructure\Bus\Event\DomainEvent;

abstract class AggregateRoot
{
    private $domainEvents = [];

    final public function pullDomainEvents()
    {
        $domainEvents       = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function raise(DomainEvent $domainEvent)
    {
        $this->domainEvents[] = $domainEvent;
    }
}
