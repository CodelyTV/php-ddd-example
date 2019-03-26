<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Lessons\Infrastructure\Persistence;

use CodelyTv\Mooc\Lessons\Domain\Lesson;
use CodelyTv\Mooc\Lessons\Domain\LessonRepository;
use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineRepository;

final class LessonRepositoryMySql extends DoctrineRepository implements LessonRepository
{
    public function save(Lesson $lesson): void
    {
        $this->persist($lesson);
    }

    public function search(LessonId $id): ?Lesson
    {
        return $this->repository(Lesson::class)->find($id);
    }
}
