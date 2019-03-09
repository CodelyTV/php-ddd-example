<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Students\Infrastructure\Persistence;

use CodelyTv\Mooc\Students\Domain\StudentId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class StudentIdType extends StringType
{
    public const NAME = 'student_id';

    public function getName(): string
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new StudentId($value);
    }

    /** @var StudentId $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }
}

