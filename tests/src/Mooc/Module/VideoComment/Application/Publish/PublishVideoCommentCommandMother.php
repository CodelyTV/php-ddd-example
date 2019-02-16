<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\VideoComment\Application\Publish;

use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Mooc\VideoComment\Contract\PublishVideoCommentCommand;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentId;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Test\Mooc\Module\Video\Domain\VideoIdMother;
use CodelyTv\Test\Mooc\Module\VideoComment\Domain\VideoCommentContentMother;
use CodelyTv\Test\Mooc\Module\VideoComment\Domain\VideoCommentIdMother;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class PublishVideoCommentCommandMother
{
    public static function create(
        Uuid $requestId,
        VideoCommentId $id,
        VideoId $videoId,
        VideoCommentContent $content
    ): PublishVideoCommentCommand
    {
        return new PublishVideoCommentCommand($requestId, $id->value(), $videoId->value(), $content->value());
    }

    public static function random(): PublishVideoCommentCommand
    {
        return self::create(
            new Uuid(UuidMother::random()),
            VideoCommentIdMother::random(),
            VideoIdMother::random(),
            VideoCommentContentMother::random()
        );
    }
}
