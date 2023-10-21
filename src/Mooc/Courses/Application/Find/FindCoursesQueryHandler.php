<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\pipe;

final class FindCoursesQueryHandler implements QueryHandler
{

    /** @var callable */
    private $finder;

    /**
     * @param CoursesFinder $finder
     */
    public function __construct(CoursesFinder $finder)
    {
        $this->finder = pipe($finder, new CoursesResponseConverter());
    }

    public function __invoke(FindCoursesQuery $query): CoursesResponse
    {
        return apply($this->finder);
    }
}
