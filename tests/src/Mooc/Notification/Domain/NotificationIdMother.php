<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Notification\Mother;

use CodelyTv\Mooc\Notification\Domain\NotificationId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class NotificationIdMother
{
    public static function create(string $id): NotificationId
    {
        return new NotificationId($id);
    }

    public static function random(): NotificationId
    {
        return self::create(UuidMother::random());
    }
}
