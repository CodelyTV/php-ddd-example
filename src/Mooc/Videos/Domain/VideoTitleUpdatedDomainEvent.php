<?php


namespace CodelyTv\Mooc\Videos\Domain;


use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

class VideoTitleUpdatedDomainEvent extends DomainEvent
{
    private string $title;

    public function __construct(string $id, string $title, string $eventId = null, string $occurredOn = null)
    {
        parent::__construct($id, $eventId, $occurredOn);
        $this->title = $title;

    }

    public function toPrimitives(): array
    {
        return [
            'title' => $this->title
        ];
    }

    public static function fromPrimitives(string $aggregateId, array $body, string $eventId, string $occurredOn): DomainEvent
    {
        return new self($aggregateId, $body['title'], $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'video.title.updated';
    }

    public function title(): string
    {
        return $this->title;
    }
}