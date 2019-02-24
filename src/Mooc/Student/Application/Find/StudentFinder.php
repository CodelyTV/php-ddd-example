<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Student\Application\Find;

use CodelyTv\Mooc\Student\Domain\StudentNotExist;
use CodelyTv\Mooc\Student\Domain\StudentId;
use CodelyTv\Mooc\Student\Domain\StudentRepository;

final class StudentFinder
{
    private $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StudentId $id)
    {
        $student = $this->repository->search($id);

        if (null === $student) {
            throw new StudentNotExist($id);
        }

        return $student;
    }
}
