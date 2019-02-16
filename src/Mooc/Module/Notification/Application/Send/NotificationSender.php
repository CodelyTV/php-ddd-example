<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Module\Notification\Application\Send;

use CodelyTv\Mooc\Module\Notification\Domain\NotificationText;
use CodelyTv\Mooc\Module\Notification\Domain\NotificationType;
use CodelyTv\Mooc\Module\Notification\Domain\Notifier;

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
