<?php

namespace CodelyTv\Mooc\VideoLike\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

class VideoLikeCreatedDomainEvent extends DomainEvent
{
    public function __construct(
        string $id,
        private readonly string $userId,
        private readonly string $videoId,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'video_like.created';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self($aggregateId, $body['user_id'], $body['video_id'], $eventId, $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'user_id' => $this->userId,
            'video_id' => $this->videoId,
        ];
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function videoId(): string
    {
        return $this->videoId;
    }
}