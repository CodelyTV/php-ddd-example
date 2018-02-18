<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Domain;

use CodelyTv\Context\Video\Module\User\Domain\User;
use CodelyTv\Context\Video\Module\User\Domain\Users;
use CodelyTv\Test\Shared\Domain\RepeatStub;

final class UsersStub
{
    public static function create(User ...$users)
    {
        return new Users($users);
    }

    public static function random()
    {
        return self::create(...RepeatStub::random(self::creator()));
    }

    private static function creator()
    {
        return function () {
            return UserStub::random();
        };
    }
}
