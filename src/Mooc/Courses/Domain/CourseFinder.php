<?php


namespace CodelyTv\Mooc\Courses\Domain;


use CodelyTv\Mooc\Shared\Domain\Course\CourseId;

class CourseFinder
{
    private $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
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