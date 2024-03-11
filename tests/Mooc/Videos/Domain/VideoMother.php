<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Domain;

use CodelyTv\Mooc\Courses\Application\Create\CreateCourseCommand;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Application\Create\CreateVideoCommand;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;

final class VideoMother
{
    public static function create(
        ?VideoId $id = null,
        ?VideoType $type = null,
        ?VideoTitle $title = null,
        ?VideoUrl $url = null,
        ?CourseId $courseId = null
    ): Video {
        return new Video(
            $id ?? VideoIdMother::create(),
            $type ?? VideoTypeMother::create(),
            $title ?? VideoTitleMother::create(),
            $url ?? VideoUrlMother::create(),
            $courseId ?? CourseIdMother::create()
        );
    }

    public static function fromRequest(CreateVideoCommand $request): Video
    {
        return self::create(
            VideoIdMother::create($request->id()),
            VideoTypeMother::create($request->type()),
            VideoTitleMother::create($request->title()),
            VideoUrlMother::create($request->url()),
            CourseIdMother::create($request->courseId()),
        );
    }
}
