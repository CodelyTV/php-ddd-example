<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\Course\Domain;

use CodelyTv\Context\Course\Module\Course\Domain\CourseCreatedDomainEvent;
use CodelyTv\Context\Course\Module\Course\Domain\CourseDescription;
use CodelyTv\Context\Course\Module\Course\Domain\CourseTitle;
use CodelyTv\Shared\Domain\CourseId;

final class CourseCreatedDomainEventStub
{
    public static function create(
        CourseId $id,
        CourseTitle $title,
        CourseDescription $description
    ): CourseCreatedDomainEvent {
        return new CourseCreatedDomainEvent(
            $id->value(),
            [
                'title' => $title->value(),
                'description' => $description->value()
            ]
        );
    }

    public static function random(): CourseCreatedDomainEvent
    {
        return self::create(
            CourseIdStub::random(),
            CourseTitleStub::random(),
            CourseDescriptionStub::random()
        );
    }
}
