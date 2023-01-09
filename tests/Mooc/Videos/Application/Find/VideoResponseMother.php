<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Application\Find;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoId;
use CodelyTv\Mooc\Videos\Application\Find\VideoResponse;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Mooc\Videos\Domain\VideoUrl;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoIdMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoTitleMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoTypeMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoUrlMother;

final class VideoResponseMother
{
    public static function create(?VideoId $id = null, ?VideoTitle $title = null, ?VideoUrl $url = null, ?VideoType $type = null, ?CourseId $courseId = null): VideoResponse
    {
        return new VideoResponse(
            $id ? $id->value() : VideoIdMother::create()->value(),
            $type ? $type->value() : VideoTypeMother::create()->value(),
            $title ? $title->value() : VideoTitleMother::create()->value(),
            $url ? $url->value() : VideoUrlMother::create()->value(),
            $courseId ? $courseId->value() : CourseIdMother::create()->value()
        );
    }
}
