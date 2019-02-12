<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Domain;

use CodelyTv\Context\Video\Module\User\Domain\UserName;
use CodelyTv\Test\Shared\Domain\WordMother;

final class UserNameMother
{
    public static function create(string $name)
    {
        return new UserName($name);
    }

    public static function random()
    {
        return self::create(WordMother::random());
    }
}
