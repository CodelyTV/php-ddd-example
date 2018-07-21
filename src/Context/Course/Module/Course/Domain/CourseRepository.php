<?php

namespace CodelyTv\Context\Course\Module\Course\Domain;

use CodelyTv\Shared\Domain\CourseId;

interface CourseRepository
{
    public function save(Course $course);

    public function search(CourseId $id): ?Course;
}
