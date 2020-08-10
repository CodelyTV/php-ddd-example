<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Update;

use CodelyTv\Mooc\Courses\Application\Update\RenameCourseCommand;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseNameMother;

final class RenameCourseCommandMother
{
    public static function create(CourseId $id, CourseName $name): RenameCourseCommand
    {
        return new RenameCourseCommand($id->value(), $name->value());
    }

    public static function withId(CourseId $id): RenameCourseCommand
    {
        return self::create($id, CourseNameMother::random());
    }
}
