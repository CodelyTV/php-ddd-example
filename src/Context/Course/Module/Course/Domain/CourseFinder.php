<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\Course\Domain;

use CodelyTv\Context\Course\Module\Course\Domain\Exception\CourseNotFound;
use CodelyTv\Shared\Domain\CourseId;

final class CourseFinder
{
    private $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CourseId $id): Course
    {
        $course = $this->repository->search($id);

        $this->guard($id, $course);

        return $course;
    }

    private function guard(CourseId $id, Course $course = null): void
    {
        if (null === $course) {
            throw new CourseNotFound($id);
        }
    }
}
