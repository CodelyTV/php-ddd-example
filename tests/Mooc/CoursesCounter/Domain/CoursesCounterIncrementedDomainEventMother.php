<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\CoursesCounter\Domain;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounter;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterId;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterIncrementedDomainEvent;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterTotal;

final class CoursesCounterIncrementedDomainEventMother
{
	public static function create(
		?CoursesCounterId $id = null,
		?CoursesCounterTotal $total = null
	): CoursesCounterIncrementedDomainEvent {
		return new CoursesCounterIncrementedDomainEvent(
			$id?->value() ?? CoursesCounterIdMother::create()->value(),
			$total?->value() ?? CoursesCounterTotalMother::create()->value()
		);
	}

	public static function fromCounter(CoursesCounter $counter): CoursesCounterIncrementedDomainEvent
	{
		return self::create($counter->id(), $counter->total());
	}
}
