<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\VideoComment\Domain;

use CodelyTv\Context\Mooc\Module\Video\Domain\VideoId;
use CodelyTv\Context\Mooc\Module\VideoComment\Contract\VideoCommentPublishedDomainEvent;
use CodelyTv\Context\Mooc\Module\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Context\Mooc\Module\VideoComment\Domain\VideoCommentId;

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
