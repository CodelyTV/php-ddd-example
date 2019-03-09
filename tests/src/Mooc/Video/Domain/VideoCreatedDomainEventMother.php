<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Video\Domain;

use CodelyTv\Mooc\Shared\Domain\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\VideoCreatedDomainEvent;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Backoffice\Course\Domain\CourseIdMother;

final class VideoCreatedDomainEventMother
{
    public static function create(
        VideoId $id,
        VideoType $type,
        VideoTitle $title,
        VideoUrl $url,
        CourseId $courseId
    ): VideoCreatedDomainEvent {
        return new VideoCreatedDomainEvent(
            $id->value(),
            [
                'type'     => $type->value(),
                'title'    => $title->value(),
                'url'      => $url->value(),
                'courseId' => $courseId->value(),
            ]
        );
    }

    public static function random(): VideoCreatedDomainEvent
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
