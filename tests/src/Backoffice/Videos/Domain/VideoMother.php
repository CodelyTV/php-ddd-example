<?php


namespace CodelyTv\Tests\Backoffice\Videos\Domain;


use CodelyTv\Backoffice\Videos\Domain\Video;
use CodelyTv\Backoffice\Videos\Domain\VideoId;

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