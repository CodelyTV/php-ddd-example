<?php

namespace CodelyTv\Context\Meetup\Module\Video\Test\Stub;

use CodelyTv\Context\Meetup\Module\Video\Domain\VideoTitle;
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
