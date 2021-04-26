<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Courses\Domain\CoursesNotFound;

final class AllCoursesFinder
{
    public function __construct(private CourseRepository $repository)
    {
    }

    public function __invoke(): array
    {
        $courses = $this->repository->findAll();

        if (null === $courses) {
            throw new CoursesNotFound();
        }

        return $courses;
    }
}
