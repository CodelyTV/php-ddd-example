<?php

declare(strict_types=1);

namespace CodelyTv\Analytics\DomainEvents\Domain;

final class AnalyticsDomainEvent
{
    public function __construct(private AnalyticsDomainEventId $id, private AnalyticsDomainEventAggregateId $aggregateId, private AnalyticsDomainEventName $name, private AnalyticsDomainEventBody $body)
    {
    }

    public function id(): AnalyticsDomainEventId
    {
        return $this->id;
    }

    public function aggregateId(): AnalyticsDomainEventAggregateId
    {
        return $this->aggregateId;
    }

    public function name(): AnalyticsDomainEventName
    {
        return $this->name;
    }

    public function body(): AnalyticsDomainEventBody
    {
        return $this->body;
    }
}
