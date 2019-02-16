<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Module\Notification\Infrastructure\Notifier;

use CodelyTv\Mooc\Module\Notification\Domain\NotificationText;
use CodelyTv\Mooc\Module\Notification\Domain\NotificationType;
use CodelyTv\Mooc\Module\Notification\Domain\Notifier;

final class FakeNotifier implements Notifier
{
    public function notify(NotificationText $text, NotificationType $action)
    {
        // I do nothing n.n
    }
}
