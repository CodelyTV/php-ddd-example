<?php

namespace CodelyTv\Context\Video\Module\Notification\Application\Create;

use CodelyTv\Context\Video\Module\Notification\Domain\NotificationText;
use CodelyTv\Context\Video\Module\Notification\Domain\NotificationType;
use CodelyTv\Context\Video\Module\Video\Domain\VideoCreatedDomainEvent;
use function Lambdish\Phunctional\apply;

final class CreateNotificationOnVideoCreated
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
