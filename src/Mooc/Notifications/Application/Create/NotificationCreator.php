<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notifications\Application\Create;

use CodelyTv\Mooc\Notifications\Domain\Notification;
use CodelyTv\Mooc\Notifications\Domain\NotificationId;
use CodelyTv\Mooc\Notifications\Domain\NotificationText;
use CodelyTv\Mooc\Notifications\Domain\NotificationType;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Shared\Infrastructure\Uuid\UuidGenerator;

final class NotificationCreator
{
    private $uuidGenerator;
    private $publisher;

    public function __construct(
        UuidGenerator $uuidGenerator,
        DomainEventPublisher $publisher
    ) {
        $this->uuidGenerator = $uuidGenerator;
        $this->publisher     = $publisher;
    }

    public function __invoke(NotificationText $text, NotificationType $action)
    {
        $id = new NotificationId($this->uuidGenerator->next());

        $notification = Notification::create($id, $text, $action);

        $this->publisher->publish(...$notification->pullDomainEvents());
    }
}
