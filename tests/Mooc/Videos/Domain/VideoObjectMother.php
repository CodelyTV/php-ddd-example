<?php
namespace CodelyTv\Tests\Mooc\Videos\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class VideoObjectMother
{
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
}