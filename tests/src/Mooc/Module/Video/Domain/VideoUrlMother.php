<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\Video\Domain;

use CodelyTv\Mooc\Module\Video\Domain\VideoUrl;
use CodelyTv\Test\Shared\Domain\UrlMother;

final class VideoUrlMother
{
    public static function create(string $url)
    {
        return new VideoUrl($url);
    }

    public static function random()
    {
        return self::create(UrlMother::random());
    }
}
