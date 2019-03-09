<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notifications\Application\Send;

use CodelyTv\Mooc\Notifications\Domain\NotificationText;
use CodelyTv\Mooc\Notifications\Domain\NotificationType;
use CodelyTv\Mooc\Notifications\Domain\Notifier;

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
