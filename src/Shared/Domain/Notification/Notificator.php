<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\Notification;

interface Notificator
{
    public function notify(Notification $notification): void;
}
