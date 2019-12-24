<?php

declare (strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Modify\Description;

use CodelyTv\Mooc\Videos\Domain\VideoDescription;
use CodelyTv\Mooc\Videos\Domain\VideoFinder;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

final class VideoDescriptionModifier
{
    private $finder;
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->finder     = new VideoFinder($repository);
        $this->repository = $repository;
    }

    public function modify(VideoId $videoId, VideoDescription $newVideoDescription): void
    {
        $video = $this->finder->__invoke($videoId);

        $video->modifyDescription($newVideoDescription);

        $this->repository->save($video);
    }
}
