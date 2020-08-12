<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

final class FindAllCoursesQueryHandler implements QueryHandler
{
    private AllCoursesFinder $courseFinder;

    public function __construct(AllCoursesFinder $courseFinder)
    {
        $this->courseFinder = $courseFinder;
    }

    public function __invoke(FindAllCoursesQuery $findAllCoursesQuery): FindAllCoursesResponse
    {
        return $this->courseFinder->__invoke();
    }
}
