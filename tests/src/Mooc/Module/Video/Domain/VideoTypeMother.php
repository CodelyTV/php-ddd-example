<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\Video\Domain;

use CodelyTv\Mooc\Module\Video\Domain\VideoType;

final class VideoTypeMother
{
    public static function create(string $title)
    {
        return new VideoType($title);
    }

    public static function random(): VideoType
    {
        return VideoType::random();
    }
}
