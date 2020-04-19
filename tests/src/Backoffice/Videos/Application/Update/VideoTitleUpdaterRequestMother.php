<?php


namespace CodelyTv\Tests\Backoffice\Videos\Application\Update;


use CodelyTv\Backoffice\Videos\Application\Update\VideoTitleUpdaterRequest;
use CodelyTv\Backoffice\Videos\Domain\Video;
use CodelyTv\Tests\Backoffice\Videos\Domain\VideoMother;

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