<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\CoursesCounter\Infrastructure\Persistence;

use CodelyTv\OpenFlight\CoursesCounter\Domain\CoursesCounter;
use CodelyTv\OpenFlight\CoursesCounter\Domain\CoursesCounterRepository;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineCoursesCounterRepository extends DoctrineRepository implements CoursesCounterRepository
{
    public function save(CoursesCounter $counter): void
    {
        $this->persist($counter);
    }

    public function search(): ?CoursesCounter
    {
        return $this->repository(CoursesCounter::class)->findOneBy([]);
    }
}
