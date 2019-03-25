<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Shared\Domain\Courses;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class CourseIdMother
{
    public static function create(string $id): CourseId
    {
        return new CourseId($id);
    }

    public static function random(): CourseId
    {
        return self::create(UuidMother::random());
    }
}
