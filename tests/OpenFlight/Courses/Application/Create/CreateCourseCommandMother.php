<?php

declare(strict_types=1);

namespace CodelyTv\Tests\OpenFlight\Courses\Application\Create;

use CodelyTv\OpenFlight\Courses\Application\Create\CreateCourseCommand;
use CodelyTv\OpenFlight\Courses\Domain\CourseDuration;
use CodelyTv\OpenFlight\Courses\Domain\CourseName;
use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;
use CodelyTv\Tests\OpenFlight\Courses\Domain\CourseDurationMother;
use CodelyTv\Tests\OpenFlight\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\OpenFlight\Courses\Domain\CourseNameMother;

final class CreateCourseCommandMother
{
    public static function create(
        ?CourseId $id = null,
        ?CourseName $name = null,
        ?CourseDuration $duration = null
    ): CreateCourseCommand {
        return new CreateCourseCommand(
            $id?->value() ?? CourseIdMother::create()->value(),
            $name?->value() ?? CourseNameMother::create()->value(),
            $duration?->value() ?? CourseDurationMother::create()->value()
        );
    }
}
