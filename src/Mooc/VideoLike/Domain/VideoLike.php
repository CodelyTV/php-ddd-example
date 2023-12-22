<?php

namespace CodelyTv\Mooc\VideoLike\Domain;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

class VideoLike extends AggregateRoot
{
    public function __construct(
        private VideoLikeId $id,
        private UserId $userId,
        private VideoId $videoId
    ) {
    }

    public static function create(VideoLikeId $id, UserId $userId, VideoId $videoId): self
    {
        $videoLike = new self($id, $userId, $videoId);

        $videoLike->record(new VideoLikeCreatedDomainEvent($id->value(), $userId->value(), $videoId->value()));

        return $videoLike;
    }

    public function id(): VideoLikeId
    {
        return $this->id;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function videoId(): VideoId
    {
        return $this->videoId;
    }
}