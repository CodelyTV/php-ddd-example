<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\VideoComments\Domain;

use CodelyTv\Mooc\VideoComments\Contract\VideoCommentPublishedDomainEvent;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentContent;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentId;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Test\Mooc\Videos\Domain\VideoIdMother;

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
                'content' => $content->value(),
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
