<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\Video\Domain;

use CodelyTv\Context\Mooc\Module\Video\Domain\VideoCreatedDomainEvent;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoId;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoTitle;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoType;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdMother;

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
