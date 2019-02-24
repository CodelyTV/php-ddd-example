<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Student\Domain;

use CodelyTv\Mooc\Student\Application\Find\StudentResponse;
use CodelyTv\Mooc\Student\Domain\StudentTotalVideosCreated;
use CodelyTv\Mooc\Student\Domain\StudentId;
use CodelyTv\Mooc\Student\Domain\StudentName;

final class StudentResponseMother
{
    public static function create(StudentId $id, StudentName $name, StudentTotalVideosCreated $totalPendingVideos)
    {
        return new StudentResponse($id->value(), $name->value(), $totalPendingVideos->value());
    }

    public static function random()
    {
        return self::create(StudentIdMother::random(), StudentNameMother::random(), StudentTotalVideosCreatedMother::random());
    }
}
