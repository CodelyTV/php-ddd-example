<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Courses\Domain;

use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;

interface CourseRepository
{
    public function save(Course $course): void;

    public function search(CourseId $id): ?Course;
}
