<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Video\Domain;

use CodelyTv\Mooc\Video\Domain\VideoType;

final class VideoTypeMother
{
    public static function create(string $title): VideoType
    {
        return new VideoType($title);
    }

    public static function random(): VideoType
    {
        return VideoType::random();
    }
}
