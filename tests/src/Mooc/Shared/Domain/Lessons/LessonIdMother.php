<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Shared\Domain\Lessons;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class LessonIdMother
{
    public static function create(string $id): LessonId
    {
        return new LessonId($id);
    }

    public static function random(): LessonId
    {
        return self::create(UuidMother::random());
    }
}
