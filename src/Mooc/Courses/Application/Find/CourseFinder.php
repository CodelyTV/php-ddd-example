<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Courses\Domain\CouserEntity;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;

final class CourseFinder
{
    private CourseRepository $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CourseId $id): CouserEntity
    {
        return $this->repository->search($id);
    }
}
