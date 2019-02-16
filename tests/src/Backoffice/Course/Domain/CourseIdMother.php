<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Backoffice\Course\Domain;

use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class CourseIdMother
{
    public static function create(string $id)
    {
        return new CourseId($id);
    }

    public static function random()
    {
        return self::create(UuidMother::random());
    }
}
