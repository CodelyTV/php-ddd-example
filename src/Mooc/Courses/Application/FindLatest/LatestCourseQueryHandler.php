<?php
declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\FindLatest;

use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

final class LatestCourseQueryHandler implements QueryHandler
{

    public function __construct(private LatestCourseFinder $latestCourseFinder)
    {
    }

    public function __invoke(LatestCourseQuery $latestCourseCommand)
    {
        return $this->latestCourseFinder->__invoke();
    }


}
