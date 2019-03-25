<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Videos\Application\Create;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Application\Create\CreateVideoCommand;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Test\Mooc\Shared\Domain\Courses\CourseIdMother;
use CodelyTv\Test\Mooc\Shared\Domain\Videos\VideoUrlMother;
use CodelyTv\Test\Mooc\Videos\Domain\VideoIdMother;
use CodelyTv\Test\Mooc\Videos\Domain\VideoTitleMother;
use CodelyTv\Test\Mooc\Videos\Domain\VideoTypeMother;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class CreateVideoCommandMother
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
            new Uuid(UuidMother::random()),
            VideoIdMother::random(),
            VideoTypeMother::random(),
            VideoTitleMother::random(),
            VideoUrlMother::random(),
            CourseIdMother::random()
        );
    }
}
