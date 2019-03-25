<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Students\Application\Find;

use CodelyTv\Mooc\Students\Application\Find\FindStudentQuery;
use CodelyTv\Mooc\Students\Domain\StudentId;
use CodelyTv\Test\Mooc\Students\Domain\StudentIdMother;

final class FindStudentQueryMother
{
    public static function create(StudentId $id): FindStudentQuery
    {
        return new FindStudentQuery($id->value());
    }

    public static function random(): FindStudentQuery
    {
        return self::create(StudentIdMother::random());
    }
}
