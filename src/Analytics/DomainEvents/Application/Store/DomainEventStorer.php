<?php

declare(strict_types=1);

namespace CodelyTv\Analytics\DomainEvents\Application\Store;

use CodelyTv\Analytics\DomainEvents\Domain\AnalyticsDomainEvent;
use CodelyTv\Analytics\DomainEvents\Domain\AnalyticsDomainEventAggregateId;
use CodelyTv\Analytics\DomainEvents\Domain\AnalyticsDomainEventBody;
use CodelyTv\Analytics\DomainEvents\Domain\AnalyticsDomainEventId;
use CodelyTv\Analytics\DomainEvents\Domain\AnalyticsDomainEventName;
use CodelyTv\Analytics\DomainEvents\Domain\DomainEventsRepository;

final readonly class DomainEventStorer
{
	public function __construct(private DomainEventsRepository $repository) {}

	public function store(
		AnalyticsDomainEventId $id,
		AnalyticsDomainEventAggregateId $aggregateId,
		AnalyticsDomainEventName $name,
		AnalyticsDomainEventBody $body
	): void {
		$domainEvent = new AnalyticsDomainEvent($id, $aggregateId, $name, $body);

		$this->repository->save($domainEvent);
	}
}
