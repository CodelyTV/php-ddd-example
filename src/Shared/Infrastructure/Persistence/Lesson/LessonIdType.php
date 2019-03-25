<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Persistence\Lesson;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class LessonIdType extends StringType
{
    public const NAME = 'lesson_id';

    public function getName(): string
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new LessonId($value);
    }

    /** @var LessonId $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }
}
