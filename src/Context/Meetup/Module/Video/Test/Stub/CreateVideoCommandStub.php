<?php

namespace CodelyTv\Context\Meetup\Module\Video\Test\Stub;

use CodelyTv\Context\Meetup\Module\Video\Domain\Create\CreateVideoCommand;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoId;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoTitle;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Shared\Test\Stub\CourseIdStub;

final class CreateVideoCommandStub
{
    public static function create(VideoId $id, VideoTitle $title, VideoUrl $url, CourseId $courseId)
    {
        return new CreateVideoCommand($id->value(), $title->value(), $url->value(), $courseId->value());
    }

    public static function random() : CreateVideoCommand
    {
        return self::create(
            VideoIdStub::random(),
            VideoTitleStub::random(),
            VideoUrlStub::random(),
            CourseIdStub::random()
        );
    }
}
