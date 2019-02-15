<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Mooc\Module\Video\Domain;

use CodelyTv\Context\Mooc\Module\Video\Domain\VideoType;

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
