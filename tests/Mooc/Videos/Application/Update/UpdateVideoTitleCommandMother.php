<?php

namespace CodelyTv\Tests\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Videos\Application\Update\UpdateVideoTitleCommand;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoIdMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoTitleMother;
use PHPUnit\Framework\TestCase;

class UpdateVideoTitleCommandMother extends TestCase
{
    public static function create(
        ?VideoId $id = null,
        ?VideoTitle $title = null
    ): UpdateVideoTitleCommand
    {
        return new UpdateVideoTitleCommand(
            $id->value() ?? VideoIdMother::create()->value(),
            $title->value() ?? VideoTitleMother::create()->value()
        );
    }

    public static function withIdAndTitle(VideoId $id, VideoTitle $title): UpdateVideoTitleCommand
    {
        return self::create($id, $title);
    }
}
