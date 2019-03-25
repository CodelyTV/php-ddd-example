<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Videos\Domain;

use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Test\Shared\Domain\WordMother;

final class VideoTitleMother
{
    public static function create(string $title): VideoTitle
    {
        return new VideoTitle($title);
    }

    public static function random(): VideoTitle
    {
        return self::create(WordMother::random());
    }
}
