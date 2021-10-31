<?php

namespace CodelyTv\Tests\Mooc\Videos\Infrastructure;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\Videos;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class VideoRepositoryRandomFake implements VideoRepository
{
    public function save(Video $video): void
    {

    }

    public function search(VideoId $id): ?Video
    {
        return self::getRandomVideoWithId($id->value());
    }

    public function searchByCriteria(Criteria $criteria): Videos
    {
        return self::getRandomVideos();
    }

    public static function getRandomVideoWithId(string $idValue): Video
    {
        return new Video(
            new VideoId((new Uuid($idValue))->value()),
            VideoType::random(),
            new VideoTitle('foobar'),
            new VideoUrl('https://www.foobar.com/foo'),
            new CourseId(CourseId::random()->value())
        );
    }

    public static function getRandomVideos(): Videos
    {
        return new Videos([self::getRandomVideoWithId(Uuid::random()->value())]);
    }
}