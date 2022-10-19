<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Courses\Domain\CourseFinder as DomainCourseFinder;

final class CourseFinder
{
    private DomainCourseFinder $finder;

    public function __construct(CourseRepository $repository)
    {
        $this->finder = new DomainCourseFinder($repository);
    }

    public function __invoke(CourseId $id): Course
    {
        $course = $this->finder->__invoke($id);

        if (null === $course) {
            throw new CourseNotExist($id);
        }

        return $course;
    }
}
