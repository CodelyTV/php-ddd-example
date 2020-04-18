<?php


namespace CodelyTv\Tests\Mooc\Videos\Application\Update;


use CodelyTv\Mooc\Videos\Application\Update\VideoTitleUpdaterRequest;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoTitleMother;
use CodelyTv\Tests\Shared\Domain\UuidMother;

final class VideoTitleUpdaterRequestMother
{
    public static function create(string $videoId, string $videoTitle): VideoTitleUpdaterRequest
    {
        return new VideoTitleUpdaterRequest($videoId, $videoTitle);
    }

    public static function random(): VideoTitleUpdaterRequest
    {
        return self::create(UuidMother::random(), VideoTitleMother::random());
    }
}