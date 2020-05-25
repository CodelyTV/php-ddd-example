<?php
declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Update;

use CodelyTv\Mooc\Courses\Application\Update\CourseRenamerCommand;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseNameMother;

final class CourseRenamerCommandMother
{
    public static function random(): CourseRenamerCommand
    {
        return self::create(CourseId::random(), CourseNameMother::random());
    }

    public static function create(CourseId $courseId, CourseName $newName): CourseRenamerCommand
    {
        return new CourseRenamerCommand($courseId->value(), $newName->value());
    }
}