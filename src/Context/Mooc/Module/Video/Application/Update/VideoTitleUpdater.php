<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Mooc\Module\Video\Application\Update;

use CodelyTv\Context\Mooc\Module\Video\Domain\VideoFinder;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoId;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoRepository;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoTitle;

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
