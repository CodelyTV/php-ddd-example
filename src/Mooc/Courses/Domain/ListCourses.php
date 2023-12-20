<?php

namespace CodelyTv\Mooc\Courses\Domain;

class ListCourses
{
    public function __construct(private readonly CourseRepository $repository)
    {
    }

    public function listCourses(): CourseCollection
    {
        return $this->repository->list();
    }
}