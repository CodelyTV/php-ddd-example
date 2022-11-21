<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use CodelyTv\Shared\Domain\ValueObject\UserId;

final class VideoLike extends AggregateRoot
{
    public function __construct(
        private readonly VideoLikeId $id,
        private readonly VideoId $videoId,
        private readonly UserId $userId,
    ) {
    }

    public static function create(
        VideoLikeId $id,
        VideoId $videoId,
        UserId $userId
    ): VideoLike {
        $video = new self($id, $videoId, $userId);

        $video->record(
            new VideoLikeCreatedDomainEvent(
                $id->value(),
                $videoId->value(),
                $userId->value()
            )
        );

        return $video;
    }
}