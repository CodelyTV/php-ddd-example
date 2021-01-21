<?php
declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\FindLatest;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Courses\Domain\NotExistCourseException;

final class LatestCourseFinder
{
    public function __construct(private CourseRepository $repository)
    {
    }

    public function __invoke(): Course
    {
        $course = $this->repository->searchLatest();

        var_dump($course);
        die();

        if (null === $course) {
            throw new NotExistCourseException();
        }

        return $course;
    }
}
