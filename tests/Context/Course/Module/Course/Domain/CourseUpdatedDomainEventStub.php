<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\Course\Domain;

use CodelyTv\Context\Course\Module\Course\Domain\CourseDescription;
use CodelyTv\Context\Course\Module\Course\Domain\CourseTitle;
use CodelyTv\Context\Course\Module\Course\Domain\CourseUpdatedDomainEvent;
use CodelyTv\Shared\Domain\CourseId;

final class CourseUpdatedDomainEventStub
{
    public static function create(
        CourseId $id,
        CourseTitle $title,
        CourseDescription $description
    ): CourseUpdatedDomainEvent {
        return new CourseUpdatedDomainEvent(
            $id->value(),
            [
                'title' => $title->value(),
                'description' => $description->value()
            ]
        );
    }

    public static function random(): CourseUpdatedDomainEvent
    {
        return self::create(
            CourseIdStub::random(),
            CourseTitleStub::random(),
            CourseDescriptionStub::random()
        );
    }
}
