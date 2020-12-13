<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Infrastructure\Persistence;

use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\Videos;
use CodelyTv\Shared\Domain\Criteria\Criteria;

final class VideoRepositoryInMemory implements VideoRepository
{
    private array $savedVideos = [];

    public function save(Video $video): void
    {
        $this->savedVideos[] = $video;
    }

    public function search(VideoId $id): ?Video
    {
        // TODO: Implement search() method.
    }

    public function searchByCriteria(Criteria $criteria): Videos
    {
        // TODO: Implement searchByCriteria() method.
    }

    public function searchLastPublishedVideo(): ?Video
    {
        return $this->savedVideos[0] ?? null;
    }
}
