<?php

namespace CodelyTv\Mooc\Courses\Application\List;

use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

class ListCoursesQueryHandler implements QueryHandler
{
    public function __construct(private readonly ListCourses $listCourses)
    {
    }

    public function __invoke(ListCoursesQuery $query): ListCoursesResponse
    {
        $courses = $this->listCourses->__invoke();
        return new ListCoursesResponse($courses);
    }
}