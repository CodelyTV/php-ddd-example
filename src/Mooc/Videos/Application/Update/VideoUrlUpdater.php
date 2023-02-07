<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Videos\Domain\VideoFinder;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;

final class VideoUrlUpdater
{
    private readonly VideoFinder $finder;

    public function __construct(private readonly VideoRepository $repository)
    {
        $this->finder = new VideoFinder($repository);
    }

    public function __invoke(VideoId $id, VideoUrl $newUrl): void
    {
        $video = $this->finder->__invoke($id);

        $video->updateUrl($newUrl);

        $this->repository->save($video);
    }
}
