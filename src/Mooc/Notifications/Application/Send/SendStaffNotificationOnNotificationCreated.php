<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notifications\Application\Send;

use CodelyTv\Mooc\Notifications\Domain\NotificationCreatedDomainEvent;
use CodelyTv\Mooc\Notifications\Domain\NotificationText;
use CodelyTv\Mooc\Notifications\Domain\NotificationType;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class SendStaffNotificationOnNotificationCreated implements DomainEventSubscriber
{
    private $sender;

    public function __construct(NotificationSender $sender)
    {
        $this->sender = $sender;
    }

    public static function subscribedTo(): array
    {
        return [NotificationCreatedDomainEvent::class];
    }

    public function __invoke(NotificationCreatedDomainEvent $event)
    {
        $text = new NotificationText($event->text());
        $type = new NotificationType($event->type());

        $this->sender->__invoke($text, $type);
    }
}
