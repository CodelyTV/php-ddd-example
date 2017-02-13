<?php

namespace CodelyTv\Context\Video\Module\Video\Domain\Find;

use CodelyTv\Context\Video\Module\Video\Domain\Video;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoRepository;

final class VideoFinder
{
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(VideoId $id)
    {
        $video = $this->repository->search($id);

        $this->guard($id, $video);

        return $video;
    }

    private function guard(VideoId $id, Video $video = null)
    {
        if (null === $video) {
            throw new VideoNotFound($id);
        }
    }
}
