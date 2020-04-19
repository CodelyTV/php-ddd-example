<?php


namespace CodelyTv\Tests\Backoffice\Videos\Domain;


use CodelyTv\Backoffice\Videos\Domain\VideoTitle;
use CodelyTv\Tests\Shared\Domain\WordMother;

class VideoTitleMother
{
    public static function random(): VideoTitle
    {
        return new VideoTitle(WordMother::random());
    }
}