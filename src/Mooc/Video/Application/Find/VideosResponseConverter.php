<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Video\Application\Find;

use CodelyTv\Mooc\Video\Domain\Video;
use CodelyTv\Mooc\Video\Domain\Videos;
use function Lambdish\Phunctional\map;

final class VideosResponseConverter
{
    public function __invoke(Videos $videos): VideosResponse
    {
        return new VideosResponse(map(function (Video $video) {
            return new VideoResponse(
                $video->id()->value(),
                $video->type()->value(),
                $video->title()->value(),
                $video->url()->value(),
                $video->courseId()->value()
            );
        }, $videos));
    }
}
