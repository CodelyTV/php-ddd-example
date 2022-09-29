<?php

namespace CodelyTv\Tests\Mooc\Videos\Infrastructure;

use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\Videos;
use CodelyTv\Shared\Domain\Criteria\Criteria;

class VideoRepositoryNullFake implements VideoRepository
{
    public function save(Video $video): void
    {
    }

    public function search(VideoId $id): ?Video
    {
        return null;
    }

    public function searchByCriteria(Criteria $criteria): Videos
    {
        return new Videos([]);
    }
}