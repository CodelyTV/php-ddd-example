<?php

namespace CodelyTv\Context\Video\Module\Video\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\Review\Domain\ReviewId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class ReviewIdType extends StringType
{
    const NAME = 'review_id';

    public function getName()
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new ReviewId($value);
    }

    /** @var ReviewId $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }
}
