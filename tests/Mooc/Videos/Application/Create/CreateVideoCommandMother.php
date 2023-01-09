<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Application\Create;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoId;
use CodelyTv\Mooc\Videos\Application\Create\CreateVideoCommand;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Mooc\Videos\Domain\VideoUrl;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoIdMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoTitleMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoTypeMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoUrlMother;

final class CreateVideoCommandMother
{
    public static function create(
        ?VideoId $id = null,
        ?VideoType $type = null,
        ?VideoTitle $title = null,
        ?VideoUrl $url = null,
        ?CourseId $courseId = null
    ): CreateVideoCommand {
        return new CreateVideoCommand(
            $id?->value() ?? VideoIdMother::create()->value(),
            $type?->value() ?? VideoTypeMother::create()->value(),
            $title?->value() ?? VideoTitleMother::create()->value(),
            $url?->value() ?? VideoUrlMother::create()->value(),
            $courseId?->value() ?? CourseIdMother::create()->value()
        );
    }
}
