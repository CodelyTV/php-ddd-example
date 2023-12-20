<?php

namespace CodelyTv\Mooc\Courses\Domain;


class CourseCollection
{
    private array $courses;

    public function __construct(Course ...$courses)
    {
        $this->courses = $courses;
    }

    public function courses(): array
    {
        return $this->courses;
    }
}