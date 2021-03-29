<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Videos\Application\Update;

use CodelyTv\OpenFlight\Videos\Domain\VideoFinder;
use CodelyTv\OpenFlight\Videos\Domain\VideoId;
use CodelyTv\OpenFlight\Videos\Domain\VideoRepository;
use CodelyTv\OpenFlight\Videos\Domain\VideoTitle;

final class VideoTitleUpdater
{
    private VideoFinder $finder;

    public function __construct(private VideoRepository $repository)
    {
        $this->finder = new VideoFinder($repository);
    }

    public function __invoke(VideoId $id, VideoTitle $newTitle): void
    {
        $video = $this->finder->__invoke($id);

        $video->updateTitle($newTitle);

        $this->repository->save($video);
    }
}
