<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

final class FindLastPublishedVideoQueryHandler
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function __invoke(FindLastPublishedVideoQuery $findLastPublishedVideoQuery): ?Video
    {
        return $this->videoRepository->searchLastPublishedVideo();
    }
}
