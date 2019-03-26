<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Lessons\Domain;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;

interface LessonRepository
{
    public function save(Lesson $lesson): void;

    public function search(LessonId $id): ?Lesson;
}
