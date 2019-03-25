<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Students\Domain;

use CodelyTv\Mooc\Students\Domain\StudentName;
use CodelyTv\Test\Shared\Domain\WordMother;

final class StudentNameMother
{
    public static function create(string $name): StudentName
    {
        return new StudentName($name);
    }

    public static function random(): StudentName
    {
        return self::create(WordMother::random());
    }
}
