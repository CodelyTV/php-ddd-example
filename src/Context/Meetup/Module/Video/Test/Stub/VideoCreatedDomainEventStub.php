<?php

namespace CodelyTv\Context\Meetup\Module\Video\Test\Stub;

use CodelyTv\Context\Meetup\Module\Video\Domain\Create\VideoCreatedDomainEvent;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoId;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoTitle;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Shared\Test\Stub\CourseIdStub;

final class VideoCreatedDomainEventStub
{
    public static function create(VideoId $id, VideoTitle $title, VideoUrl $url, CourseId $courseId)
    {
        return new VideoCreatedDomainEvent(
            $id->value(),
            [
                'title'    => $title->value(),
                'url'      => $url->value(),
                'courseId' => $courseId->value(),
            ]
        );
    }

    public static function random() : VideoCreatedDomainEvent
    {
        return self::create(
            VideoIdStub::random(),
            VideoTitleStub::random(),
            VideoUrlStub::random(),
            CourseIdStub::random()
        );
    }
}
