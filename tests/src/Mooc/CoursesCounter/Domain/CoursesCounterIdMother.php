<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Mooc\CoursesCounter\Domain;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterId;
use CodelyTv\Tests\Shared\Domain\UuidMother;

final class CoursesCounterIdMother
{
    public static function create(string $value): CoursesCounterId
    {
        return new CoursesCounterId($value);
    }

    public static function random(): CoursesCounterId
    {
        return self::create(UuidMother::random());
    }
}
