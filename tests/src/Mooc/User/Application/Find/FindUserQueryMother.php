<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\User\Application\Find;

use CodelyTv\Mooc\User\Application\Find\FindUserQuery;
use CodelyTv\Mooc\User\Domain\UserId;
use CodelyTv\Test\Mooc\User\Domain\UserIdMother;

final class FindUserQueryMother
{
    public static function create(UserId $id)
    {
        return new FindUserQuery($id->value());
    }

    public static function random()
    {
        return self::create(UserIdMother::random());
    }
}
