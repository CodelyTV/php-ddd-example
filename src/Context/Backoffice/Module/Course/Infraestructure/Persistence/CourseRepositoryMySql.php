<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Backoffice\Module\Course\Infraestructure\Persistence;

use CodelyTv\Context\Backoffice\Module\Course\Domain\Course;
use CodelyTv\Context\Backoffice\Module\Course\Domain\CourseRepository;
use CodelyTv\Shared\Infrastructure\Doctrine\Repository;

final class CourseRepositoryMySql extends Repository implements CourseRepository
{
    public function save(Course $course): void
    {
        $this->persist($course);
    }
}
