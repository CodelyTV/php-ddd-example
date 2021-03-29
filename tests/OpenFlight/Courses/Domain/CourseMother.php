<?php

declare(strict_types=1);

namespace CodelyTv\Tests\OpenFlight\Courses\Domain;

use CodelyTv\OpenFlight\Courses\Application\Create\CreateCourseCommand;
use CodelyTv\OpenFlight\Courses\Domain\Course;
use CodelyTv\OpenFlight\Courses\Domain\CourseDuration;
use CodelyTv\OpenFlight\Courses\Domain\CourseName;
use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;

final class CourseMother
{
    public static function create(
        ?CourseId $id = null,
        ?CourseName $name = null,
        ?CourseDuration $duration = null
    ): Course {
        return new Course(
            $id ?? CourseIdMother::create(),
            $name ?? CourseNameMother::create(),
            $duration ?? CourseDurationMother::create()
        );
    }

    public static function fromRequest(CreateCourseCommand $request): Course
    {
        return self::create(
            CourseIdMother::create($request->id()),
            CourseNameMother::create($request->name()),
            CourseDurationMother::create($request->duration())
        );
    }
}
