<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Video\Domain;

final class VideosFinder
{
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): Videos
    {
        $videos = $this->repository->findAll();

        return $videos;
    }
}
