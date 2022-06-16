<?php

declare(strict_types=1);

namespace CodelyTv\Analytics\DomainEvents\Domain;

final class AnalyticsDomainEvent
{
    public function __construct(
        private readonly AnalyticsDomainEventId $id,
        private readonly AnalyticsDomainEventAggregateId $aggregateId,
        private readonly AnalyticsDomainEventName $name,
        private readonly AnalyticsDomainEventBody $body
    ) {
    }
}
