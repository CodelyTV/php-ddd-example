<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Infrastructure\Persistence\Types;

use CodelyTv\Context\Video\Module\User\Domain\UserId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class CourseOpinionIdType extends StringType
{
    public const NAME = 'course_opinion_id';

    public function getName(): string
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new UserId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }
}

