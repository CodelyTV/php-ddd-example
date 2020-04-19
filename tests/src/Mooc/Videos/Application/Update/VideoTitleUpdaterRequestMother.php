<?php


namespace CodelyTv\Tests\Mooc\Videos\Application\Update;


use CodelyTv\Mooc\Videos\Application\Update\VideoTitleUpdaterRequest;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoMother;

final class VideoTitleUpdaterRequestMother
{
    private static function create(string $videoId, string $videoTitle): VideoTitleUpdaterRequest
    {
        return new VideoTitleUpdaterRequest($videoId, $videoTitle);
    }

    public static function random(): VideoTitleUpdaterRequest
    {
        return self::createFrom(VideoMother::random());
    }

    public static function createFrom(Video $video): VideoTitleUpdaterRequest
    {
        return self::create($video->id()->value(), $video->title()->value());
    }

}