<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain\Aggregate;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Collection;
use function Lambdish\Phunctional\reduce;

abstract class AggregateRootCollection extends Collection
{
    /** @return DomainEvent[] */
    public function pullDomainEvents(): array
    {
        return reduce($this->pullItemDomainEvents(), $this, []);
    }

    private function pullItemDomainEvents(): callable
    {
        return function (array $accumulatedEvents, AggregateRoot $aggregateRoot): array {
            return array_merge($accumulatedEvents, $aggregateRoot->pullDomainEvents());
        };
    }
}
