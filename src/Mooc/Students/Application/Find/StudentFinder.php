<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Students\Application\Find;

use CodelyTv\Mooc\Students\Domain\Student;
use CodelyTv\Mooc\Students\Domain\StudentId;
use CodelyTv\Mooc\Students\Domain\StudentNotExist;
use CodelyTv\Mooc\Students\Domain\StudentRepository;

final class StudentFinder
{
    private $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StudentId $id): Student
    {
        $student = $this->repository->search($id);

        if (null === $student) {
            throw new StudentNotExist($id);
        }

        return $student;
    }
}
