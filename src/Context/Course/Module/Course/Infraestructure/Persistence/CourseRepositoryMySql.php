<?php

namespace CodelyTv\Context\Course\Module\Course\Infraestructure\Persistence;

use CodelyTv\Context\Course\Module\Course\Domain\Course;
use CodelyTv\Context\Course\Module\Course\Domain\CourseRepository;
use CodelyTv\Infrastructure\Doctrine\Repository;

final class CourseRepositoryMySql extends Repository implements CourseRepository
{
    public function save(Course $course): void
    {
        $this->persist($course);
    }
}
