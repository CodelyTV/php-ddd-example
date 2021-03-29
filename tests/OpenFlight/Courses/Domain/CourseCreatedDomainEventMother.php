<?php

declare(strict_types=1);

namespace CodelyTv\Tests\OpenFlight\Courses\Domain;

use CodelyTv\OpenFlight\Courses\Domain\Course;
use CodelyTv\OpenFlight\Courses\Domain\CourseCreatedDomainEvent;
use CodelyTv\OpenFlight\Courses\Domain\CourseDuration;
use CodelyTv\OpenFlight\Courses\Domain\CourseName;
use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;

final class CourseCreatedDomainEventMother
{
    public static function create(
        ?CourseId $id = null,
        ?CourseName $name = null,
        ?CourseDuration $duration = null
    ): CourseCreatedDomainEvent {
        return new CourseCreatedDomainEvent(
            $id?->value() ?? CourseIdMother::create()->value(),
            $name?->value() ?? CourseNameMother::create()->value(),
            $duration?->value() ?? CourseDurationMother::create()->value()
        );
    }

    public static function fromCourse(Course $course): CourseCreatedDomainEvent
    {
        return self::create($course->id(), $course->name(), $course->duration());
    }
}
