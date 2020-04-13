<?php


namespace CodelyTv\Mooc\Courses\Application\FindAll;



use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

final class FindAllCoursesQueryHandler implements QueryHandler
{
    private CoursesFinder $finder;

    public function __construct(CoursesFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(FindAllCoursesQuery $command)
    {
        return $this->finder->__invoke();
    }
}