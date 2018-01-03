<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Test\Stub;

use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoResponse;
use CodelyTv\Context\Video\Module\Video\Domain\VideoTitle;
use CodelyTv\Context\Video\Module\Video\Domain\VideoType;
use CodelyTv\Context\Video\Module\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Shared\Test\Stub\CourseIdStub;

final class VideoResponseStub
{
    public static function create(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, CourseId $courseId): VideoResponse
    {
        return new VideoResponse($id->value(), $type->value(), $title->value(), $url->value(), $courseId->value());
    }

    public static function random(): VideoResponse
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
