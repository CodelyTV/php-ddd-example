<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Domain;

interface CourseRepository
{
    public function save(Course $course);
}
