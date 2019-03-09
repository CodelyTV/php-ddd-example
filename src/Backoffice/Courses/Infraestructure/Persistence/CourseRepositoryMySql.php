<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Courses\Infraestructure\Persistence;

use CodelyTv\Backoffice\Courses\Domain\Course;
use CodelyTv\Backoffice\Courses\Domain\CourseRepository;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineRepository;

final class CourseRepositoryMySql extends DoctrineRepository implements CourseRepository
{
    public function save(Course $course): void
    {
        $this->persist($course);
    }
}
