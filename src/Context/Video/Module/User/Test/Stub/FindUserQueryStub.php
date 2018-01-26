<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Test\Stub;

use CodelyTv\Context\Video\Module\User\Application\Find\FindUserQuery;
use CodelyTv\Context\Video\Module\User\Domain\UserId;

final class FindUserQueryStub
{
    public static function create(UserId $id)
    {
        return new FindUserQuery($id->value());
    }

    public static function random()
    {
        return self::create(UserIdStub::random());
    }
}
