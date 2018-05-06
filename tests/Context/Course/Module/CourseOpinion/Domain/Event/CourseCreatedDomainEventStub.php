<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Event;

use CodelyTv\Context\Course\Module\Course\Domain\Event\CourseCreatedDomainEvent;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseDescription;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseTitle;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseDescriptionStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseTitleStub;

final class CourseCreatedDomainEventStub
{
    public static function random(): CourseCreatedDomainEvent
    {
        return self::create(
            CourseIdStub::random(),
            CourseTitleStub::random(),
            CourseDescriptionStub::random()
        );
    }

    public static function create(
        CourseId $id,
        CourseTitle $title,
        CourseDescription $description
    ): CourseCreatedDomainEvent {
        return new CourseCreatedDomainEvent(
            $id->value(),
            [
                'title'       => $title->value(),
                'description' => $description->value(),
            ]
        );
    }
}
