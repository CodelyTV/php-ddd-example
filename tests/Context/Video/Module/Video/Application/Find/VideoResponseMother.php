<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\Video\Application\Find;

use CodelyTv\Context\Mooc\Module\Video\Application\Find\VideoResponse;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoId;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoTitle;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoType;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdMother;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdMother;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoTitleMother;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoTypeMother;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoUrlMother;

final class VideoResponseMother
{
    public static function create(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, CourseId $courseId): VideoResponse
    {
        return new VideoResponse($id->value(), $type->value(), $title->value(), $url->value(), $courseId->value());
    }

    public static function random(): VideoResponse
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
