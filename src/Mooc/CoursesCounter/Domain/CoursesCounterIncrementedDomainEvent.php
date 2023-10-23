<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\CoursesCounter\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

final class CoursesCounterIncrementedDomainEvent extends DomainEvent
{
	public function __construct(
		string $aggregateId,
		private readonly int $total,
		string $eventId = null,
		string $occurredOn = null
	) {
		parent::__construct($aggregateId, $eventId, $occurredOn);
	}

	public static function eventName(): string
	{
		return 'courses_counter.incremented';
	}

	public static function fromPrimitives(
		string $aggregateId,
		array $body,
		string $eventId,
		string $occurredOn
	): DomainEvent {
		return new self($aggregateId, $body['total'], $eventId, $occurredOn);
	}

	public function toPrimitives(): array
	{
		return [
			'total' => $this->total,
		];
	}
}
