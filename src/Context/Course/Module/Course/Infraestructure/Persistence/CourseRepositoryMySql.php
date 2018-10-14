<?php

namespace CodelyTv\Context\Course\Module\Course\Infraestructure\Persistence;

use CodelyTv\Context\Course\Module\Course\Domain\Course;
use CodelyTv\Context\Course\Module\Course\Domain\CourseRepository;
use CodelyTv\Infrastructure\Doctrine\Repository;
use CodelyTv\Shared\Domain\CourseId;

final class CourseRepositoryMySql extends Repository implements CourseRepository
{
    public function save(Course $course): void
    {
        $this->persist($course);
    }

    public function search(CourseId $id): ?Course
    {
        return $this->repository(Course::class)->find($id);
    }
}
