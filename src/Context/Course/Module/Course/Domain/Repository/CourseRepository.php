<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\Course\Domain\Repository;

use CodelyTv\Context\Course\Module\Course\Domain\Entity\Course;
use CodelyTv\Shared\Domain\CourseId;

interface CourseRepository
{
    public function findById(CourseId $id): ?Course;

    public function save(Course $course);
}
