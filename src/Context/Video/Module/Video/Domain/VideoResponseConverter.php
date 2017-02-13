<?php

namespace CodelyTv\Context\Video\Module\Video\Domain;

final class VideoResponseConverter
{
    public function __invoke(Video $video)
    {
        return new VideoResponse($video->id()->value(), $video->title()->value(), $video->url(), $video->courseId());
    }
}
