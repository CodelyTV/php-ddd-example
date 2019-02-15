<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\Notification\Mother;

use CodelyTv\Context\Mooc\Module\Notification\Domain\NotificationId;
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
