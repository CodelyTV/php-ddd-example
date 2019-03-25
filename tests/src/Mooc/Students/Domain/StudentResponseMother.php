<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Students\Domain;

use CodelyTv\Mooc\Students\Application\Find\StudentResponse;
use CodelyTv\Mooc\Students\Domain\StudentId;
use CodelyTv\Mooc\Students\Domain\StudentName;
use CodelyTv\Mooc\Students\Domain\StudentTotalVideosCreated;

final class StudentResponseMother
{
    public static function create(
        StudentId $id,
        StudentName $name,
        StudentTotalVideosCreated $totalPendingVideos
    ): StudentResponse {
        return new StudentResponse($id->value(), $name->value(), $totalPendingVideos->value());
    }

    public static function random(): StudentResponse
    {
        return self::create(
            StudentIdMother::random(),
            StudentNameMother::random(),
            StudentTotalVideosCreatedMother::random()
        );
    }
}
