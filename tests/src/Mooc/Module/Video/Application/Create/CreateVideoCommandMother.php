<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\Video\Application\Create;

use CodelyTv\Mooc\Module\Video\Application\Create\CreateVideoCommand;
use CodelyTv\Mooc\Module\Video\Domain\VideoId;
use CodelyTv\Mooc\Module\Video\Domain\VideoTitle;
use CodelyTv\Mooc\Module\Video\Domain\VideoType;
use CodelyTv\Mooc\Module\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Test\Backoffice\Course\Domain\CourseIdMother;
use CodelyTv\Test\Mooc\Module\Video\Domain\VideoIdMother;
use CodelyTv\Test\Mooc\Module\Video\Domain\VideoTitleMother;
use CodelyTv\Test\Mooc\Module\Video\Domain\VideoTypeMother;
use CodelyTv\Test\Mooc\Module\Video\Domain\VideoUrlMother;
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
