<?php

namespace CodelyTv\Context\Video\Module\Notification\Domain;

interface Notifier
{
    public function notify(NotificationText $text, NotificationType $action);
}
