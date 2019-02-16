<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\User\Domain;

use CodelyTv\Mooc\Module\User\Domain\User;
use CodelyTv\Mooc\Module\User\Domain\Users;
use CodelyTv\Test\Shared\Domain\RepeatMother;

final class UsersMother
{
    public static function create(User ...$users)
    {
        return new Users($users);
    }

    public static function random()
    {
        return self::create(...RepeatMother::random(self::creator()));
    }

    private static function creator()
    {
        return function () {
            return UserMother::random();
        };
    }
}
