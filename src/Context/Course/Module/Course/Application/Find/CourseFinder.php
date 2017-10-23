<?php

namespace CodelyTv\Context\Course\Module\Course\Application\Find;

use CodelyTv\Context\Course\Module\Course\Domain\Course;
use CodelyTv\Context\Course\Module\Course\Domain\CourseNotFound;
use CodelyTv\Context\Course\Module\Course\Domain\CourseRepository;
use CodelyTv\Shared\Domain\CourseId;

final class CourseFinder
{
    private $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CourseId $id)
    {
        $course = $this->repository->search($id);

        $this->existsCourse($id, $course);

        return $course;
    }

    private function existsCourse(CourseId $id, Course $course = null)
    {
        if (null === $course) {
            throw new CourseNotFound($id);
        }
    }
}
