<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Infrastructure\Persistence;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
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

    public function findLast(): ?Course
    {
        return $this->repository(Course::class)
                    ->createQueryBuilder("course")
                    // Doctrine\ORM\Query\QueryException: [Semantical Error] line 0, col 78 near 'createdAt DE': Error: Class CodelyTv\Mooc\Courses\Domain\Course has no field or association named createdAt
                    //->orderBy("course.createdAt", "DESC")
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();
    }
}
