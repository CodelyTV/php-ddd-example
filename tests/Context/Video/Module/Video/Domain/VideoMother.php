<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\Video\Domain;

use CodelyTv\Context\Mooc\Module\Video\Domain\Video;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoId;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoTitle;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoType;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdMother;

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
