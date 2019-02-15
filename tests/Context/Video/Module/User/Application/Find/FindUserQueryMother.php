<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Application\Find;

use CodelyTv\Context\Mooc\Module\User\Application\Find\FindUserQuery;
use CodelyTv\Context\Mooc\Module\User\Domain\UserId;
use CodelyTv\Test\Context\Video\Module\User\Domain\UserIdMother;

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
