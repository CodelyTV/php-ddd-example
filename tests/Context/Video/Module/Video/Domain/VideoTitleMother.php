<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\Video\Domain;

use CodelyTv\Context\Video\Module\Video\Domain\VideoTitle;
use CodelyTv\Test\Shared\Domain\WordMother;

final class VideoTitleMother
{
    public static function create(string $title)
    {
        return new VideoTitle($title);
    }

    public static function random()
    {
        return self::create(WordMother::random());
    }
}
