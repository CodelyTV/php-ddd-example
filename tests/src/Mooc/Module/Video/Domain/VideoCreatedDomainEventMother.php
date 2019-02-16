<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\Video\Domain;

use CodelyTv\Mooc\Video\Domain\VideoCreatedDomainEvent;
use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Mooc\Video\Domain\VideoTitle;
use CodelyTv\Mooc\Video\Domain\VideoType;
use CodelyTv\Mooc\Video\Domain\VideoUrl;
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
