<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Video\Application\Find;

use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoResponse;
use CodelyTv\Context\Video\Module\Video\Domain\VideoTitle;
use CodelyTv\Context\Video\Module\Video\Domain\VideoType;
use CodelyTv\Context\Video\Module\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoTitleStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoTypeStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoUrlStub;

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
