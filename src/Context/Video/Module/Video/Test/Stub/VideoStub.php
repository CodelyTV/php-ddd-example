<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Test\Stub;

use CodelyTv\Context\Video\Module\Video\Domain\Video;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoTitle;
use CodelyTv\Context\Video\Module\Video\Domain\VideoType;
use CodelyTv\Context\Video\Module\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Shared\Test\Stub\CourseIdStub;

final class VideoStub
{
    public static function create(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, CourseId $courseId)
    {
        return new Video($id, $type, $title, $url, $courseId);
    }

    public static function withId(VideoId $id)
    {
        return self::create($id, VideoTypeStub::random(), VideoTitleStub::random(), VideoUrlStub::random(), CourseIdStub::random());
    }

    public static function random(): Video
    {
        return self::create(
            VideoIdStub::random(),
            VideoTypeStub::random(),
            VideoTitleStub::random(),
            VideoUrlStub::random(),
            CourseIdStub::random()
        );
    }
}
