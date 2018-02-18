<?php

namespace CodelyTv\Test\Context\Video\Module\Video\Domain;

use CodelyTv\Context\Video\Module\Video\Domain\VideoTitle;
use CodelyTv\Test\Shared\Domain\WordStub;

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
