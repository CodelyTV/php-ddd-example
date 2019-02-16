<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\Video\Domain;

use CodelyTv\Mooc\Video\Domain\Video;
use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Mooc\Video\Domain\VideoTitle;
use CodelyTv\Mooc\Video\Domain\VideoType;
use CodelyTv\Mooc\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Backoffice\Course\Domain\CourseIdMother;

final class VideoMother
{
    public static function withId(VideoId $id)
    {
        return self::create(
            $id,
            VideoTypeMother::random(),
            VideoTitleMother::random(),
            VideoUrlMother::random(),
            CourseIdMother::random()
        );
    }

    public static function create(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, CourseId $courseId)
    {
        return new Video($id, $type, $title, $url, $courseId);
    }

    public static function random(): Video
    {
        return self::create(
            VideoIdMother::random(),
            VideoTypeMother::random(),
            VideoTitleMother::random(),
            VideoUrlMother::random(),
            CourseIdMother::random()
        );
    }
}
