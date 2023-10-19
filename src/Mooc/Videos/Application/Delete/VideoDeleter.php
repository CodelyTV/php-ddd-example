<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Delete;

use CodelyTv\Mooc\Videos\Domain\VideoFinder;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

final class VideoDeleter
{
    private readonly VideoFinder $finder;

    public function __construct(private readonly VideoRepository $repository)
    {
        $this->finder = new VideoFinder($repository);
    }

    public function __invoke(VideoId $id): void
    {
        $video = $this->finder->__invoke($id);
        $this->repository->delete($video);
    }
}
