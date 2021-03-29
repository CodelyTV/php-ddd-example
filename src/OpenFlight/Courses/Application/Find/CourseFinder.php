<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Courses\Application\Find;

use CodelyTv\OpenFlight\Courses\Domain\Course;
use CodelyTv\OpenFlight\Courses\Domain\CourseNotExist;
use CodelyTv\OpenFlight\Courses\Domain\CourseRepository;
use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;

final class CourseFinder
{
    public function __construct(private CourseRepository $repository)
    {
    }

    public function __invoke(CourseId $id): Course
    {
        $course = $this->repository->search($id);

        if (null === $course) {
            throw new CourseNotExist($id);
        }

        return $course;
    }
}
