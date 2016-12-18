<?php

namespace CodelyTv\Context\Video\Module\Video\Test\Stub;

use CodelyTv\Context\Video\Module\Video\Domain\VideoTitle;
use CodelyTv\Test\Stub\WordStub;

final class VideoTitleStub
{
    public static function create(string $title)
    {
        return new VideoTitle($title);
    }

    public static function random()
    {
        return self::create(WordStub::random());
    }
}
