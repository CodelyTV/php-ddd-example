<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\Course\Infrastructure\Persistence\Repository;

use CodelyTv\Context\Course\Module\Course\Domain\Entity\Course;
use CodelyTv\Context\Course\Module\Course\Domain\Repository\CourseRepository;
use CodelyTv\Infrastructure\Doctrine\Repository;
use CodelyTv\Shared\Domain\CourseId;

final class CourseRepositoryMySql extends Repository implements CourseRepository
{
    public function save(Course $course): void
    {
        $this->persist($course);
    }

    public function findById(CourseId $id): ?Course
    {
        return $this->repository(Course::class)->find($id);
    }
}
