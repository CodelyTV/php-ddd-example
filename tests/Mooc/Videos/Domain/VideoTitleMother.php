<?php

namespace CodelyTv\Tests\Mooc\Videos\Domain;

use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Tests\Shared\Domain\WordMother;

class VideoTitleMother
{
    public static function create(?string $value = null): VideoTitle
    {
        return new VideoTitle($value ?? WordMother::create());
    }
}
