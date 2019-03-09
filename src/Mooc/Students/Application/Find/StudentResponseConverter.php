<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Students\Application\Find;

use CodelyTv\Mooc\Students\Domain\Student;

final class StudentResponseConverter
{
    public function __invoke(Student $student)
    {
        return new StudentResponse(
            $student->id()->value(),
            $student->name()->value(),
            $student->totalVideosCreated()->value()
        );
    }
}
