<?php

namespace CodelyTv\Mooc\Courses\Application\List;

use CodelyTv\Mooc\Courses\Domain\CourseCollection;
use CodelyTv\Mooc\Courses\Domain\ListCourses as DomainListCourses;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;

class ListCourses
{
    private readonly DomainListCourses $listCourses;

    public function __construct(CourseRepository $repository)
    {
        $this->listCourses = new DomainListCourses($repository);
    }

    public function __invoke(): CourseCollection
    {
        return $this->listCourses->listCourses();
    }
}