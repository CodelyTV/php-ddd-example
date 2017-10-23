<?php

namespace CodelyTv\Context\Course\Module\Course\Application\Find;

use CodelyTv\Context\Course\Module\Course\Domain\CourseResponseConverter;
use CodelyTv\Shared\Domain\CourseId;
use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\pipe;

final class FindCourseQueryHandler
{
    private $finder;

    public function __construct(CourseFinder $finder)
    {
        $this->finder = pipe($finder, new CourseResponseConverter());
    }

    public function __invoke(FindCourseQuery $query)
    {
        $id = new CourseId($query->id());

        return apply($this->finder, [$id]);
    }
}
