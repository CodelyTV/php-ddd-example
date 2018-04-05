<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Domain;

use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Test\Shared\Domain\UuidStub;

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
