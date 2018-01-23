<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Test\Stub;

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