<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoId;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoCreatedDomainEvent;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Mooc\Videos\Domain\VideoUrl;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;

final class VideoCreatedDomainEventMother
{
    public static function create(
        ?VideoId $id = null,
        ?VideoType $type = null,
        ?VideoTitle $title = null,
        ?VideoUrl $url = null,
        ?CourseId $courseId = null
    ): VideoCreatedDomainEvent {
        return new VideoCreatedDomainEvent(
            $id?->value() ?? VideoIdMother::create()->value(),
            $type?->value() ?? VideoTypeMother::create()->value(),
            $title?->value() ?? VideoTitleMother::create()->value(),
            $url?->value() ?? VideoUrlMother::create()->value(),
            $courseId?->value() ?? CourseIdMother::create()->value()
        );
    }

    public static function fromVideo(Video $Video): VideoCreatedDomainEvent
    {
        return self::create($Video->id(), $Video->type(), $Video->title(), $Video->url(), $Video->courseId());
    }
}
