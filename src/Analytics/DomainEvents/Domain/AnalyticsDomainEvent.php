<?php

declare(strict_types=1);

namespace CodelyTv\Analytics\DomainEvents\Domain;

final readonly class AnalyticsDomainEvent
{
	public function __construct(
		private AnalyticsDomainEventId $id,
		private AnalyticsDomainEventAggregateId $aggregateId,
		private AnalyticsDomainEventName $name,
		private AnalyticsDomainEventBody $body
	) {}
}
