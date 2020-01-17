<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Backoffice\Courses\Domain;

use CodelyTv\Backoffice\Courses\Domain\BackofficeCourse;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseDurationMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseNameMother;

final class BackofficeCourseMother
{
    public static function create(string $id, string $name, string $duration): BackofficeCourse
    {
        return new BackofficeCourse($id, $name, $duration);
    }

    public static function withName(string $name)
    {
        return self::create(
            CourseIdMother::random()->value(),
            $name,
            CourseDurationMother::random()->value()
        );
    }

    public static function random(): BackofficeCourse
    {
        return self::create(
            CourseIdMother::random()->value(),
            CourseNameMother::random()->value(),
            CourseDurationMother::random()->value()
        );
    }
}
