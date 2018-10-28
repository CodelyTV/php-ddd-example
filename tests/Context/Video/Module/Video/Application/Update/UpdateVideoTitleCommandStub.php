<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\Video\Application\Update;

use CodelyTv\Context\Video\Module\Video\Application\Update\UpdateVideoTitleCommand;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoTitle;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoTitleStub;
use CodelyTv\Test\Shared\Domain\UuidStub;

final class UpdateVideoTitleCommandStub
{
    public static function create(
        Uuid $requestId,
        VideoId $id,
        VideoTitle $title
    ): UpdateVideoTitleCommand {
        return new UpdateVideoTitleCommand(
            $requestId,
            $id->value(),
            $title->value()
        );
    }

    public static function random(): UpdateVideoTitleCommand
    {
        return self::create(
            new Uuid(UuidStub::random()),
            VideoIdStub::random(),
            VideoTitleStub::random()
        );
    }
}
