<?php

namespace CodelyTv\Test\Context\Video\Module\Notification\Stub;

use CodelyTv\Context\Video\Module\Notification\Domain\NotificationId;
use CodelyTv\Test\Infrastructure\Stub\UuidStub;

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
