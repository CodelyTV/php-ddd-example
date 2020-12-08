<?php


namespace CodelyTv\Mooc\Courses\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Response;

final class CoursesResponse implements Response
{
    private $courses;

    public function __construct(CourseResponse ...$courses)
    {
        $this->courses = $courses;
    }

    public function courses(): array
    {
        return $this->courses;
    }
}