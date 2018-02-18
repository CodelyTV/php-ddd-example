<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Video\Domain;

use CodelyTv\Context\Video\Module\Video\Domain\VideoType;

final class VideoTypeStub
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
