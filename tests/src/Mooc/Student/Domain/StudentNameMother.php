<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Student\Domain;

use CodelyTv\Mooc\Student\Domain\StudentName;
use CodelyTv\Test\Shared\Domain\WordMother;

final class StudentNameMother
{
    public static function create(string $name)
    {
        return new StudentName($name);
    }

    public static function random()
    {
        return self::create(WordMother::random());
    }
}
