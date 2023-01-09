<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\LastVideo\Domain;

use CodelyTv\Mooc\LastVideo\Domain\LastVideo;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoCreatedAt;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoId;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoTitle;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoType;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoUrl;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoId;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoIdMother;

final class LastVideoMother
{
    public static function create(
        ?LastVideoId $id = null,
        ?VideoId $videoId = null,
        ?LastVideoType $type = null,
        ?LastVideoTitle $title = null,
        ?LastVideoUrl $url = null,
        ?CourseId $courseId = null,
        ?LastVideoCreatedAt $createdAt = null
    ): LastVideo {
        return new LastVideo(
            $id ?? LastVideoIdMother::create(),
            $videoId ?? VideoIdMother::create(),
            $type ?? LastVideoTypeMother::create(),
            $title ?? LastVideoTitleMother::create(),
            $url ?? LastVideoUrlMother::create(),
            $courseId ?? CourseIdMother::create(),
            $createdAt ?? LastVideoCreatedAtMother::create()
        );
    }

    public static function withOne(VideoId $videoId = null, LastVideoType $type = null, LastVideoTitle $title = null, LastVideoUrl $url = null, CourseId $courseId = null, LastVideoCreatedAt $createdAt = null): LastVideo
    {
        return self::create(
            LastVideoIdMother::create(),
            $videoId ?? VideoIdMother::create(),
            $type ?? LastVideoTypeMother::create(),
            $title ?? LastVideoTitleMother::create(),
            $url ?? LastVideoUrlMother::create(),
            $courseId ?? CourseIdMother::create(),
            $createdAt ?? LastVideoCreatedAtMother::create()
        );
    }
}
