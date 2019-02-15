<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Mooc\Module\Notification\Application\Send;

use CodelyTv\Context\Mooc\Module\Notification\Domain\NotificationText;
use CodelyTv\Context\Mooc\Module\Notification\Domain\NotificationType;
use CodelyTv\Context\Mooc\Module\Notification\Domain\Notifier;

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
