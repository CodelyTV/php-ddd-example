<?php

namespace CodelyTv\Test\Context\Video\Module\Video\Domain;

use CodelyTv\Context\Video\Module\Video\Domain\VideoUrl;
use CodelyTv\Test\Shared\Domain\UrlStub;

final class VideoUrlStub
{
    public static function create(string $url)
    {
        return new VideoUrl($url);
    }

    public static function random()
    {
        return self::create(UrlStub::random());
    }
}
