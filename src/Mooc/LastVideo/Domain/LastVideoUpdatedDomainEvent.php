<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

final class LastVideoUpdatedDomainEvent extends DomainEvent
{
    public function __construct(
        string $id,
        private readonly string $videoId,
        private readonly string $type,
        private readonly string $title,
        private readonly string $url,
        private readonly string $courseId,
        private readonly string $createdAt,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'lastVideo.created';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): LastVideoUpdatedDomainEvent {
        return new self(
            $aggregateId,
            $body['videoId'],
            $body['type'],
            $body['title'],
            $body['url'],
            $body['course_id'],
            $body['created_at'],
            $eventId,
            $occurredOn
        );
    }

    public function toPrimitives(): array
    {
        return [
            'videoId' =>   $this->videoId,
            'type'      => $this->type,
            'title'     => $this->title,
            'url'       => $this->url,
            'course_id' => $this->courseId,
            'created_at' => $this->createdAt,
        ];
    }
}
