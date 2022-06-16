<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoNotFound;

final class VideoFinder
{

    public function __construct(private VideoRepository $repository)
    {
    }

    public function __invoke(VideoId $id): Video
    {
        $video = $this->repository->search($id);

        if (null === $video) {
            throw new VideoNotFound($id);
        }

        return $video;
    }
}
