<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseEmpty;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;

final class LastCourseFinder
{
    private CourseRepository $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): Course
    {
        $latestCourse = $this->repository->searchLatest();

        if (is_null($latestCourse)) {
            throw new CourseEmpty();
        }

        return $latestCourse;
    }
}
