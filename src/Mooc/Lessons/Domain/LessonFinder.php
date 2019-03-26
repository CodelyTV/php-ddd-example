<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Lessons\Domain;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;

final class LessonFinder
{
    private $repository;

    public function __construct(LessonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find(LessonId $id): Lesson
    {
        $lesson = $this->repository->search($id);

        if (null === $lesson) {
            throw new LessonNotFound($id);
        }

        return $lesson;
    }
}
