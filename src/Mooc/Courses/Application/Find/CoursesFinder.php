<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Courses\Domain\CoursesFinder as DomainCoursesFinder;

final class CoursesFinder
{
    /** @var DomainCoursesFinder */
    private $finder;

    public function __construct(CourseRepository $repository)
    {
        $this->finder = new DomainCoursesFinder($repository);
    }

    public function __invoke(): array
    {
        return $this->finder->__invoke();
    }
}
