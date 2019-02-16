<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notification\Infrastructure\Notifier;

use CodelyTv\Mooc\Notification\Domain\NotificationText;
use CodelyTv\Mooc\Notification\Domain\NotificationType;
use CodelyTv\Mooc\Notification\Domain\Notifier;

final class FakeNotifier implements Notifier
{
    public function notify(NotificationText $text, NotificationType $action)
    {
        // I do nothing n.n
    }
}
