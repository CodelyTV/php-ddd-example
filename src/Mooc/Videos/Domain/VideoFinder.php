<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

final class VideoFinder
{
    private VideoRepository $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(VideoId $id): Video
    {
        $video = $this->repository->search($id);

        $this->ensureVideoExists($id, $video);

        return $video;
    }

    private function ensureVideoExists(VideoId $id, Video $video = null): void
    {
        if (null === $video) {
            throw new VideoNotFound($id);
        }
    }
}
