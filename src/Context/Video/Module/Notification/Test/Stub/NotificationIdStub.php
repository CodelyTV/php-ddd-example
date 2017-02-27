<?php

namespace CodelyTv\Context\Video\Module\Notification\Test\Stub;

use CodelyTv\Context\Video\Module\Notification\Domain\NotificationId;
use CodelyTv\Test\Stub\UuidStub;

final class NotificationIdStub
{
    public static function create(string $id)
    {
        return new NotificationId($id);
    }

    public static function random()
    {
        return self::create(UuidStub::random());
    }
}
