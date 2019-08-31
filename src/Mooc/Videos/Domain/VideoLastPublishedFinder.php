<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Domain;

final class VideoLastPublishedFinder
{
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): Video
    {
        $video = $this->repository->searchLastPublished();

        return $video;
    }
}
