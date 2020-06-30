<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Tests\Shared\Domain\UuidMother;

final class CourseIdMother
{
    public static function create(string $value): CourseId
    {
        return new CourseId($value);
    }

    public static function creator(): callable
    {
        return static fn() => self::random();
    }

    public static function random(): CourseId
    {
        return self::create(UuidMother::random());
    }
}
