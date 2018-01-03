<?php

namespace CodelyTv\Context\Video\Module\Video\Test\Stub;

use CodelyTv\Context\Video\Module\Video\Application\Create\CreateVideoCommand;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoTitle;
use CodelyTv\Context\Video\Module\Video\Domain\VideoType;
use CodelyTv\Context\Video\Module\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Shared\Test\Stub\CourseIdStub;
use CodelyTv\Test\Stub\UuidStub;
use CodelyTv\Types\ValueObject\Uuid;

final class CreateVideoCommandStub
{
    public static function create(
        Uuid $requestId,
        VideoId $id,
        VideoType $type,
        VideoTitle $title,
        VideoUrl $url,
        CourseId $courseId
    ): CreateVideoCommand {
        return new CreateVideoCommand(
            $requestId,
            $id->value(),
            $type->value(),
            $title->value(),
            $url->value(),
            $courseId->value()
        );
    }

    public static function random(): CreateVideoCommand
    {
        return self::create(
            new Uuid(UuidStub::random()),
            VideoIdStub::random(),
            VideoTypeStub::random(),
            VideoTitleStub::random(),
            VideoUrlStub::random(),
            CourseIdStub::random()
        );
    }
}
