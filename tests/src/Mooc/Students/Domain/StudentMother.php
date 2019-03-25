<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Students\Domain;

use CodelyTv\Mooc\Students\Domain\Student;
use CodelyTv\Mooc\Students\Domain\StudentId;
use CodelyTv\Mooc\Students\Domain\StudentName;
use CodelyTv\Mooc\Students\Domain\StudentTotalVideosCreated;

final class StudentMother
{
    public static function create(
        StudentId $id,
        StudentName $name,
        StudentTotalVideosCreated $totalPendingVideos
    ): Student {
        return new Student($id, $name, $totalPendingVideos);
    }

    public static function withId(StudentId $id): Student
    {
        return self::create($id, StudentNameMother::random(), StudentTotalVideosCreatedMother::random());
    }

    public static function withValues(string $id, string $name, int $totalPendingVideos): Student
    {
        return self::create(
            StudentIdMother::create($id),
            StudentNameMother::create($name),
            StudentTotalVideosCreatedMother::create($totalPendingVideos)
        );
    }

    public static function random(): Student
    {
        return self::create(
            StudentIdMother::random(),
            StudentNameMother::random(),
            StudentTotalVideosCreatedMother::random()
        );
    }
}
