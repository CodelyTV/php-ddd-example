<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Video\Application\Create;

use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\VideoComment\Contract\PublishVideoCommentCommand;
use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoCommentId;
use CodelyTv\Test\Stub\UuidStub;
use CodelyTv\Types\ValueObject\Uuid;

final class PublishVideoCommentCommandStub
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
            new Uuid(UuidStub::random()),
            VideoCommentIdStub::random(),
            VideoIdStub::random(),
            VideoCommentContentStub::random()
        );
    }
}
