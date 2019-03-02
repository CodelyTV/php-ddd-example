<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Student\Application\Find;

use CodelyTv\Mooc\Student\Domain\Student;

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
