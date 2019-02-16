<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notification\Application\Create;

use CodelyTv\Mooc\Notification\Domain\NotificationText;
use CodelyTv\Mooc\Notification\Domain\NotificationType;
use CodelyTv\Mooc\Video\Domain\VideoCreatedDomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use function Lambdish\Phunctional\apply;

final class CreateNotificationOnVideoCreated implements DomainEventSubscriber
{
    private $creator;

    public function __construct(NotificationCreator $creator)
    {
        $this->creator = $creator;
    }

    public static function subscribedTo(): array
    {
        return [VideoCreatedDomainEvent::class];
    }

    public function __invoke(VideoCreatedDomainEvent $event)
    {
        $text   = new NotificationText($event->title());
        $action = NotificationType::videoCreated();

        apply($this->creator, [$text, $action]);
    }
}
