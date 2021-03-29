<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Courses\Infrastructure\Persistence;

use CodelyTv\OpenFlight\Courses\Domain\Course;
use CodelyTv\OpenFlight\Courses\Domain\CourseRepository;
use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineCourseRepository extends DoctrineRepository implements CourseRepository
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
