<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Students\Domain;

use CodelyTv\Mooc\Students\Domain\StudentId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class StudentIdMother
{
    public static function create(string $id): StudentId
    {
        return new StudentId($id);
    }

    public static function random(): StudentId
    {
        return self::create(UuidMother::random());
    }
}
