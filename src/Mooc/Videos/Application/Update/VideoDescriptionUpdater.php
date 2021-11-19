<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Videos\Domain\VideoDescription;
use CodelyTv\Mooc\Videos\Domain\VideoFinder;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

final class VideoDescriptionUpdater
{
    private VideoFinder $finder;

    public function __construct(private VideoRepository $repository)
    {
        $this->finder = new VideoFinder($repository);
    }

    public function __invoke(VideoId $id, VideoDescription $newDescription): void
    {
        $video = $this->finder->__invoke($id);

        $video->updateDescription($newDescription);

        $this->repository->save($video);
    }
}