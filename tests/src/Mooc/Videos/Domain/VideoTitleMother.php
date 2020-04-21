<?php


namespace CodelyTv\Tests\Mooc\Videos\Domain;


use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Tests\Shared\Domain\WordMother;

class VideoTitleMother
{
    public static function random(): VideoTitle
    {
        return new VideoTitle(WordMother::random());
    }
}