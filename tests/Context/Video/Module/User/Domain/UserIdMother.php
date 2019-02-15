<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Domain;

use CodelyTv\Context\Mooc\Module\User\Domain\UserId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class UserIdMother
{
    public static function create(string $id)
    {
        return new UserId($id);
    }

    public static function random()
    {
        return self::create(UuidMother::random());
    }
}
