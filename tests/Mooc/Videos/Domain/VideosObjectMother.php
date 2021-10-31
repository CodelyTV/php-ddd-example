<?php

namespace CodelyTv\Tests\Mooc\Videos\Domain;

use CodelyTv\Mooc\Videos\Domain\Videos;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class VideosObjectMother
{
    public static function getRandomVideos(): Videos
    {
        return new Videos([VideoObjectMother::getRandomVideoWithId(Uuid::random()->value())]);
    }
}