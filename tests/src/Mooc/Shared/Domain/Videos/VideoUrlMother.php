<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Shared\Domain\Videos;

use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Test\Shared\Domain\UrlMother;

final class VideoUrlMother
{
    public static function create(string $url): VideoUrl
    {
        return new VideoUrl($url);
    }

    public static function random(): VideoUrl
    {
        return self::create(UrlMother::random());
    }
}
