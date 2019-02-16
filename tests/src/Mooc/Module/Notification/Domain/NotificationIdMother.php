<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\Notification\Mother;

use CodelyTv\Mooc\Notification\Domain\NotificationId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class NotificationIdMother
{
    public static function create(string $id)
    {
        return new NotificationId($id);
    }

    public static function random()
    {
        return self::create(UuidMother::random());
    }
}
