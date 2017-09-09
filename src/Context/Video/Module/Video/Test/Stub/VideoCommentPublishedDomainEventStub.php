<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Test\Stub;

use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\VideoComment\Contract\VideoCommentPublishedDomainEvent;
use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoCommentId;

final class VideoCommentPublishedDomainEventStub
{
    public static function create(
        VideoCommentId $id,
        VideoId $videoId,
        VideoCommentContent $content
    ): VideoCommentPublishedDomainEvent
    {
        return new VideoCommentPublishedDomainEvent(
            $id->value(), [
                'video_id' => $videoId->value(),
                'content'  => $content->value()
            ]
        );
    }

    public static function random(): VideoCommentPublishedDomainEvent
    {
        return self::create(
            VideoCommentIdStub::random(),
            VideoIdStub::random(),
            VideoCommentContentStub::random()
        );
    }
}
