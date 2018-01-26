<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Test\Stub;

use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Test\Stub\UuidStub;

final class UserIdStub
{
    public static function create(string $id)
    {
        return new UserId($id);
    }

    public static function random()
    {
        return self::create(UuidStub::random());
    }
}
