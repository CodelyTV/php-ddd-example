<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Video\Domain;

use CodelyTv\Mooc\Shared\Domain\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Backoffice\Course\Domain\CourseIdMother;

final class VideoMother
{
    public static function withId(VideoId $id): Video
    {
        return self::create(
            $id,
            VideoTypeMother::random(),
            VideoTitleMother::random(),
            VideoUrlMother::random(),
            CourseIdMother::random()
        );
    }

    public static function create(
        VideoId $id,
        VideoType $type,
        VideoTitle $title,
        VideoUrl $url,
        CourseId $courseId
    ): Video {
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
