<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Course\Domain;

interface CourseRepository
{
    public function save(Course $course);
}
