<?php

namespace CodelyTv\Tests\Mooc\Videos\Domain;

use CodelyTv\Mooc\Videos\Application\Find\VideoResponse;
use CodelyTv\Mooc\Videos\Domain\Video;

class VideoResponseMother
{
    public static function lovelyVideoResponse(Video $video): VideoResponse
    {
        return new VideoResponse(
            $video->id()->value(),
            $video->type()->value(),
            $video->title()->value(),
            $video->url()->value(),
            $video->courseId()->value()
        );
    }
}
