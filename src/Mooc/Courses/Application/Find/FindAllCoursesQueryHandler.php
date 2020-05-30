<?php
declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\CoursesCounter\Application\Find\FindAllCoursesResponse;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

final class FindAllCoursesQueryHandler implements QueryHandler
{
    private AllCourseFinder $courseFinder;

    public function __construct(AllCourseFinder $courseFinder)
    {
        $this->courseFinder = $courseFinder;
    }

    public function __invoke(FindAllCoursesQuery $findAllCoursesQuery): FindAllCoursesResponse
    {
        return $this->courseFinder->__invoke();
    }
}