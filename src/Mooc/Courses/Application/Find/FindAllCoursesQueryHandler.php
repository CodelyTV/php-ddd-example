<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

final class FindAllCoursesQueryHandler implements QueryHandler
{
    private AllCourseFinder $coursesFinder;

    /**
     * FindAllCoursesQueryHandler constructor.
     * @param AllCourseFinder $coursesFinder
     */
    public function __construct(AllCourseFinder $coursesFinder)
    {
        $this->coursesFinder = $coursesFinder;
    }

    public function __invoke(FindAllCoursesQuery $findAllCoursesQuery): CoursesResponse
    {
        return $this->coursesFinder->__invoke();
    }
}
