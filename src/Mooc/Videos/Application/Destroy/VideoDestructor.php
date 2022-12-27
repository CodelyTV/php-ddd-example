<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Destroy;

use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoFinder;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

final class VideoDestructor
{
    private readonly VideoFinder $finder;

    public function __construct(private readonly VideoRepository $repository)
    {
        $this->finder = new VideoFinder($repository);
    }

    public function __invoke(VideoId $id)
    {
        /** @var Video */
        $video = $this->finder->__invoke($id);

        $this->repository->destroy($video);
    }
}