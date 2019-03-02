<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Video\Application\Find;

use CodelyTv\Mooc\Video\Application\Find\VideoResponse;
use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Mooc\Video\Domain\VideoTitle;
use CodelyTv\Mooc\Video\Domain\VideoType;
use CodelyTv\Mooc\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Backoffice\Course\Domain\CourseIdMother;
use CodelyTv\Test\Mooc\Video\Domain\VideoIdMother;
use CodelyTv\Test\Mooc\Video\Domain\VideoTitleMother;
use CodelyTv\Test\Mooc\Video\Domain\VideoTypeMother;
use CodelyTv\Test\Mooc\Video\Domain\VideoUrlMother;

final class VideoResponseMother
{
    public static function create(
        VideoId $id,
        VideoType $type,
        VideoTitle $title,
        VideoUrl $url,
        CourseId $courseId
    ): VideoResponse {
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
