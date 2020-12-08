<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Courses\Domain\CoursesNotFound;

final class AllCourseFinder
{
    private courseRepository $repository;

    public function __construct(courseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): CoursesResponse
    {
        $courses = $this->repository->findAll();

        if (null === $courses) {
            throw new CoursesNotFound();
        }

        return new CoursesResponse($courses);
    }
}
