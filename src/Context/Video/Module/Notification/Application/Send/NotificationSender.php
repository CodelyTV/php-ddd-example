<?php

namespace CodelyTv\Context\Video\Module\Notification\Application\Send;

use CodelyTv\Context\Video\Module\Notification\Domain\NotificationText;
use CodelyTv\Context\Video\Module\Notification\Domain\NotificationType;
use CodelyTv\Context\Video\Module\Notification\Domain\Notifier;

final class NotificationSender
{
    private $notifier;

    public function __construct(Notifier $notifier)
    {
        $this->notifier = $notifier;
    }

    public function __invoke(NotificationText $text, NotificationType $action)
    {
        $this->notifier->notify($text, $action);

        // @todo Send event
    }
}
