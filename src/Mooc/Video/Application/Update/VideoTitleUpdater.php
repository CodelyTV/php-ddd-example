<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Video\Application\Update;

use CodelyTv\Mooc\Video\Domain\VideoFinder;
use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Mooc\Video\Domain\VideoRepository;
use CodelyTv\Mooc\Video\Domain\VideoTitle;

final class VideoTitleUpdater
{
    private $finder;
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->finder     = new VideoFinder($repository);
        $this->repository = $repository;
    }

    public function __invoke(VideoId $id, VideoTitle $newTitle): void
    {
        $video = $this->finder->__invoke($id);

        $video->updateTitle($newTitle);

        $this->repository->save($video);
    }
}
