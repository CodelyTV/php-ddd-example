<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Infrastructure;


use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\Videos;
use CodelyTv\Shared\Domain\Criteria\Criteria;

final class VideoRepositoryInMemory implements VideoRepository
{
    private array $videos = [];

    public function save(Video $video): void
    {
        $this->videos[] = $video;
    }

    public function search(VideoId $id): ?Video
    {
        foreach ($this->videos as $video) {
            if ($video->id == $id) {
                return $video;
            }
        }
        return null;
    }

    public function findLastVideo(): ?Video
    {
        $lastVideo = max($this->videos);

        return ($lastVideo) ? $lastVideo : null;
    }

    public function searchByCriteria(Criteria $criteria): Videos
    {
        // TODO Criteria
        return new Videos($this->videos);
    }
}