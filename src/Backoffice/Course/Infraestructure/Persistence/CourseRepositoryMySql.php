<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Course\Infraestructure\Persistence;

use CodelyTv\Backoffice\Course\Domain\Course;
use CodelyTv\Backoffice\Course\Domain\CourseRepository;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineRepository;

final class CourseRepositoryMySql extends DoctrineRepository implements CourseRepository
{
    public function save(Course $course): void
    {
        $this->persist($course);
    }
}
