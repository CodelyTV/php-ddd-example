<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;


class LastVideoFinder
{
    private VideoRepository $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): Video
    {
        $video = $this->repository->searchLast();
        $this->ensureVideoExists($video);

        return $video;
    }

    private function ensureVideoExists(Video $video = null): void
    {
        if (null === $video) {
            throw new LastVideoNotFound();
        }
    }
}