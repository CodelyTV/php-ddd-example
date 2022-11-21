<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

final class VideoLikeCreatedDomainEvent extends DomainEvent
{
    public function __construct(
        string $id,
        private readonly string $videoId,
        private readonly string $userId,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'videoLike.created';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): VideoCreatedDomainEvent {
        return new self(
            $aggregateId,
            $body['video_id'],
            $body['user_id'],
            $eventId,
            $occurredOn
        );
    }

    public function toPrimitives(): array
    {
        return [
            'video_id' => $this->videoId,
            'user_id'  => $this->user_id
        ];
    }
}
