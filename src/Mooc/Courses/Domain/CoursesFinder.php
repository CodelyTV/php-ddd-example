<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

final class CoursesFinder
{
    public function __construct(private CourseRepository $repository)
    {
    }

    public function __invoke(): array
    {
        /** @var array */
        $courses = $this->repository->all();

        if (null === $courses) {
            throw new CoursesNotFound();
        }

        return $courses;
    }
}
