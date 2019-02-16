<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\Video\Domain;

use CodelyTv\Mooc\Video\Domain\VideoTitle;
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
