<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\Aggregate;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use SplQueue;
use Iterator;

abstract class AggregateRoot
{
    private ?SplQueue $domainEvents = null;

    /**
     * @deprecated Use pullDomainEventsToIterator instead.
     */
	final public function pullDomainEvents(): array
	{
		return iterator_to_array($this->pullDomainEventsToIterator());
	}

    final public function pullDomainEventsToIterator(): Iterator
    {
        if (null === $this->domainEvents) {
            return new \EmptyIterator();
        }

        foreach ($this->domainEvents as $domainEvent) {
            yield $domainEvent;
        }
    }

    final protected function record(DomainEvent $domainEvent): void
    {
        if (null === $this->domainEvents) {
            $this->domainEvents = new SplQueue;
            $this->domainEvents->setIteratorMode(SplQueue::IT_MODE_DELETE);
        }

        $this->domainEvents->enqueue($domainEvent);
    }

    public function __clone()
    {
        $this->domainEvents = null;
    }
}
