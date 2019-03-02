<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Backoffice\Course\Domain;

use CodelyTv\Shared\Domain\CourseId;
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
