<?php


namespace CodelyTv\Mooc\Courses\Application\FindAll;


use CodelyTv\Mooc\Courses\Domain\CourseRepository;

final class CoursesFinder
{
    private CourseRepository $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $courses = $this->repository->findAll();

        return new AllCoursesResponse($courses);
    }
}