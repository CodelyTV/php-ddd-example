<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Domain;

final class VideoFinderLast
{
    private $repository;

    public function __construct(VideoRepositoryLast $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): Video
    {
        $video = $this->repository->searchLast();

        $this->guard($video);

        return $video;
    }

    private function guard(Video $video = null): void
    {
        if (null === $video) {
            throw new VideoNotFoundLast();
        }
    }
}
