<?php

namespace CodelyTv\Mooc\Courses\Application\List;

use CodelyTv\Mooc\Courses\Domain\CourseCollection;

class ListCoursesResponse
{
    public function __construct(private readonly CourseCollection $courses)
    {
    }

    public function courses(): CourseCollection
    {
        return $this->courses;
    }
}