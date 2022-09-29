<?php

namespace CodelyTv\Tests\Mooc\Videos\Infrastructure;

use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\Videos;
use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoObjectMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideosObjectMother;

class VideoRepositoryRandomFake implements VideoRepository
{
    public function save(Video $video): void
    {

    }

    public function search(VideoId $id): ?Video
    {
        return VideoObjectMother::getRandomVideoWithId($id->value());
    }

    public function searchByCriteria(Criteria $criteria): Videos
    {
        return VideosObjectMother::getRandomVideos();
    }
}