<?php

namespace CodelyTv\Types\Aggregate;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Types\Collection;
use function Lambdish\Phunctional\reduce;

abstract class AggregateRootCollection extends Collection
{
    /** @return DomainEvent[] */
    public function pullDomainEvents()
    {
        return reduce($this->pullItemDomainEvents(), $this, []);
    }

    private function pullItemDomainEvents()
    {
        return function (array $accumulatedEvents, AggregateRoot $aggregateRoot) {
            return array_merge($accumulatedEvents, $aggregateRoot->pullDomainEvents());
        };
    }
}
