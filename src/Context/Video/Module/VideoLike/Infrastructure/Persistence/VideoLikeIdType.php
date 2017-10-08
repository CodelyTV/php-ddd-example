<?php

namespace CodelyTv\Context\Video\Module\VideoLike\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\VideoLike\Domain\VideoLikeId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class VideoLikeIdType extends StringType
{
    const NAME = 'video_like_id';

    public function getName()
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new VideoLikeId($value);
    }

    /**
     * @var VideoLikeId $value
     *
     * @param AbstractPlatform $platform
     *
     * @return mixed|string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }
}

