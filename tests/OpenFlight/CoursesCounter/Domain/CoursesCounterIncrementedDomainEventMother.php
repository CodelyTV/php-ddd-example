<?php

declare(strict_types=1);

namespace CodelyTv\Tests\OpenFlight\CoursesCounter\Domain;

use CodelyTv\OpenFlight\CoursesCounter\Domain\CoursesCounter;
use CodelyTv\OpenFlight\CoursesCounter\Domain\CoursesCounterId;
use CodelyTv\OpenFlight\CoursesCounter\Domain\CoursesCounterIncrementedDomainEvent;
use CodelyTv\OpenFlight\CoursesCounter\Domain\CoursesCounterTotal;

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
