<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Videos\Domain;

use CodelyTv\Mooc\Videos\Domain\VideoType;

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
