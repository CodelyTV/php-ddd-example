<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Share;

use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Courses\Domain\ShareRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;

final class CoursePublisher
{
    public function __construct(private CourseRepository $courseRepository, private ShareRepository $repository)
    {
        $this->finder = new CourseFinder($courseRepository);
    }

    public function __invoke(CourseId $courseId): void
    {
        $course = $this->finder->__invoke($courseId);
        $this->repository->share($course);
    }
}
