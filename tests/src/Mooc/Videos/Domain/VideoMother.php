<?php


namespace CodelyTv\Tests\Mooc\Videos\Domain;


use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;

class VideoMother
{
    public static function random(): Video
    {
        return new Video(VideoId::random(), VideoTitleMother::random());
    }

    public static function createWithId(VideoId $id): Video
    {
        return new Video($id, VideoTitleMother::random());
    }
}