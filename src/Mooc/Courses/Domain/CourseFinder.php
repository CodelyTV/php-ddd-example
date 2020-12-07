<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;

final class CourseFinder
{
    private courseRepository $repository;

    public function __construct(courseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CourseId $id): Course
    {
        $video = $this->repository->search($id);

        $this->ensureCourseExists($id, $video);

        return $video;
    }

    private function ensureCourseExists(CourseId $id, Course $course = null): void
    {
        if (null === $course) {
            throw new CourseNotExist($id);
        }
    }
}
