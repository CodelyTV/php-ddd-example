<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Students\Domain;

use CodelyTv\Mooc\Students\Domain\Student;
use CodelyTv\Mooc\Students\Domain\Students;
use CodelyTv\Test\Shared\Domain\RepeatMother;

final class StudentsMother
{
    public static function create(Student ...$students): Students
    {
        return new Students($students);
    }

    public static function random(): Students
    {
        return self::create(...RepeatMother::random(self::creator()));
    }

    private static function creator(): callable
    {
        return function () {
            return StudentMother::random();
        };
    }
}
