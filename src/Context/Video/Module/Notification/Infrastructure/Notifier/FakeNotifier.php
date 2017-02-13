<?php

namespace CodelyTv\Context\Video\Module\Notification\Infrastructure\Notifier;

use CodelyTv\Context\Video\Module\Notification\Domain\NotificationText;
use CodelyTv\Context\Video\Module\Notification\Domain\NotificationType;
use CodelyTv\Context\Video\Module\Notification\Domain\Notifier;

final class FakeNotifier implements Notifier
{
    public function notify(NotificationText $text, NotificationType $action)
    {
        // I do nothing n.n
    }
}
