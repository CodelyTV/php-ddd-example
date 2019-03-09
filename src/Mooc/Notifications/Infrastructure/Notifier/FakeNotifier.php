<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notifications\Infrastructure\Notifier;

use CodelyTv\Mooc\Notifications\Domain\NotificationText;
use CodelyTv\Mooc\Notifications\Domain\NotificationType;
use CodelyTv\Mooc\Notifications\Domain\Notifier;

final class FakeNotifier implements Notifier
{
    public function notify(NotificationText $text, NotificationType $action): void
    {
        // I do nothing n.n
    }
}
