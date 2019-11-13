<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Infraestructure\Persistence;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\Videos;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineCriteriaConverter;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineRepository;

final class CourseRepositoryMySql extends DoctrineRepository implements CourseRepository
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
