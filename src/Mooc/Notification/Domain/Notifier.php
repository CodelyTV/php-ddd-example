<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notification\Domain;

interface Notifier
{
    public function notify(NotificationText $text, NotificationType $action);
}
