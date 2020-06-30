<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

final class VideoCreatedDomainEvent extends DomainEvent
{
    private string $type;
    private string $title;
    private string $url;
    private string $courseId;

    public function __construct(
        string $id,
        string $type,
        string $title,
        string $url,
        string $courseId,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);

        $this->type     = $type;
        $this->title    = $title;
        $this->url      = $url;
        $this->courseId = $courseId;
    }

    public static function eventName(): string
    {
        return 'video.created';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): VideoCreatedDomainEvent {
        return new self(
            $aggregateId,
            $body['type'],
            $body['title'],
            $body['url'],
            $body['course_id'],
            $eventId,
            $occurredOn
        );
    }

    public function toPrimitives(): array
    {
        return [
            'type'      => $this->type,
            'title'     => $this->title,
            'url'       => $this->url,
            'course_id' => $this->courseId,
        ];
    }
}
