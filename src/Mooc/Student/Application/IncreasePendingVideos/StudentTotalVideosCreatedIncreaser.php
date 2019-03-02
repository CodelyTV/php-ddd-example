<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Student\Application\IncreasePendingVideos;

use CodelyTv\Mooc\Student\Application\Find\StudentFinder;
use CodelyTv\Mooc\Student\Domain\StudentId;
use CodelyTv\Mooc\Student\Domain\StudentRepository;

final class StudentTotalVideosCreatedIncreaser
{
    private $finder;
    private $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->finder     = new StudentFinder($repository);
        $this->repository = $repository;
    }

    public function __invoke(StudentId $id)
    {
        $student = $this->finder->__invoke($id);

        $student->increaseTotalVideosCreated();

        $this->repository->save($student);
    }
}
