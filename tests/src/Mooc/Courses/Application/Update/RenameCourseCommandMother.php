<?php

namespace CodelyTv\Tests\Mooc\Courses\Application\Update;

use CodelyTv\Mooc\Courses\Application\Update\RenameCourseCommand;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseNameMother;

final class RenameCourseCommandMother
{
    public static function create(CourseId $id, CourseName $name): RenameCourseCommand
    {
        return new RenameCourseCommand($id->value(), $name->value());
    }

    public static function fromCourse(Course $course): RenameCourseCommand
    {
        return self::create($course->id(), CourseNameMother::random());
    }
}