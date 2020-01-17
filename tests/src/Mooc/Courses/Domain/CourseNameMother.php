<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Mooc\Courses\Domain;

use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Tests\Shared\Domain\WordMother;

final class CourseNameMother
{
    public static function create(string $value): CourseName
    {
        return new CourseName($value);
    }

    public static function random(): CourseName
    {
        return self::create(WordMother::random());
    }
}
