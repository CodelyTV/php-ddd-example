<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notifications\Domain;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class Notification extends AggregateRoot
{
    private $id;
    private $text;
    private $type;
    private $hasBeenSent;

    public function __construct(
        NotificationId $id,
        NotificationText $text,
        NotificationType $type,
        bool $hasBeenSent
    ) {
        $this->id          = $id;
        $this->text        = $text;
        $this->type        = $type;
        $this->hasBeenSent = $hasBeenSent;
    }

    public static function create(NotificationId $id, NotificationText $text, NotificationType $type): Notification
    {
        $notification = new self($id, $text, $type, false);

        $notification->record(
            new NotificationCreatedDomainEvent(
                $id->value(),
                [
                    'text' => $text->value(),
                    'type' => $type->value(),
                ]
            )
        );

        return $notification;
    }

    public function id(): NotificationId
    {
        return $this->id;
    }

    public function text(): NotificationText
    {
        return $this->text;
    }

    public function type(): NotificationType
    {
        return $this->type;
    }

    public function hasBeenSent(): bool
    {
        return $this->hasBeenSent;
    }

    public function markAsNotified(): void
    {
        $this->hasBeenSent = true;
    }
}
