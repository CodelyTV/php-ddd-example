<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Share;

use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Courses\Domain\ShareRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;

final class CoursePublisher
{
    private CourseFinder     $finder;

    public function __construct(private ShareRepository $repository)
    {
    }

    public function __invoke(CourseName $courseName): void
    {
        $this->repository->share($courseName);
    }
}
