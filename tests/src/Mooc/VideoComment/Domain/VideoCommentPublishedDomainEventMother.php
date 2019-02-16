<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\VideoComment\Domain;

use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Mooc\VideoComment\Contract\VideoCommentPublishedDomainEvent;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentId;

final class VideoCommentPublishedDomainEventMother
{
    public static function create(
        VideoCommentId $id,
        VideoId $videoId,
        VideoCommentContent $content
    ): VideoCommentPublishedDomainEvent {
        return new VideoCommentPublishedDomainEvent(
            $id->value(),
            [
                'videoId' => $videoId->value(),
                'content' => $content->value()
            ]
        );
    }

    public static function random(): VideoCommentPublishedDomainEvent
    {
        return self::create(
            VideoCommentIdMother::random(),
            VideoIdMother::random(),
            VideoCommentContentMother::random()
        );
    }
}
