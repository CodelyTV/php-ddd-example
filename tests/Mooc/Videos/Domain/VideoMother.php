<?php

namespace CodelyTv\Tests\Mooc\Videos\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class VideoMother
{
    public static function lovelyVideo(VideoId $id): Video
    {
        $type     = new VideoType(VideoType::SCREENCAST);
        $title    = new VideoTitle('Lovely video');
        $url      = new VideoUrl('https://www.video.com/lovely-video');
        $courseId = new CourseId(Uuid::random()->value());
        return Video::create($id, $type, $title, $url, $courseId);
    }
}
