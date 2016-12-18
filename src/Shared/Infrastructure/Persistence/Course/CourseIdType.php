<?php

namespace CodelyTv\Shared\Infrastructure\Persistence\Course;

use CodelyTv\Shared\Domain\CourseId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class CourseIdType extends StringType
{
    const NAME = 'course_id';

    public function getName()
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new CourseId($value);
    }

    /** @var CourseId $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }
}

