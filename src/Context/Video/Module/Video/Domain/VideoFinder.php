<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Domain;

final class VideoFinder
{
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(VideoId $id): Video
    {
        $video = $this->repository->search($id);

        $this->guard($id, $video);

        return $video;
    }

    private function guard(VideoId $id, Video $video = null): void
    {
        if (null === $video) {
            throw new VideoNotFound($id);
        }
    }
}
