<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Module\Course\Infraestructure\Persistence;

use CodelyTv\Backoffice\Module\Course\Domain\Course;
use CodelyTv\Backoffice\Module\Course\Domain\CourseRepository;
use CodelyTv\Shared\Infrastructure\Doctrine\Repository;

final class CourseRepositoryMySql extends Repository implements CourseRepository
{
    public function save(Course $course): void
    {
        $this->persist($course);
    }
}
