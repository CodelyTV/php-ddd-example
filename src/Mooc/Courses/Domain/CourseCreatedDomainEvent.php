<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

final class CourseCreatedDomainEvent extends DomainEvent
{
    public function __construct(
        string $id,
        private string $name,
        private string $duration,
        private string $createdAt,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'course.created';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self($aggregateId, $body['name'], $body['duration'], $body['createdAt'], $eventId, $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'name'      => $this->name,
            'duration'  => $this->duration,
            'createdAt' => $this->createdAt,
        ];
    }

    public function name(): string
    {
        return $this->name;
    }

    public function duration(): string
    {
        return $this->duration;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }
}
