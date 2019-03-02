<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Student\Application\Find;

use CodelyTv\Mooc\Student\Application\Find\FindStudentQuery;
use CodelyTv\Mooc\Student\Domain\StudentId;
use CodelyTv\Test\Mooc\Student\Domain\StudentIdMother;

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
