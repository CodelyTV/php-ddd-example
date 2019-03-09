<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Students\Application\IncreasePendingVideos;

use CodelyTv\Mooc\Students\Application\Find\StudentFinder;
use CodelyTv\Mooc\Students\Domain\StudentId;
use CodelyTv\Mooc\Students\Domain\StudentRepository;

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
