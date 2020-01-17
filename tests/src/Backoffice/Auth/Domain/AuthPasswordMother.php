<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Backoffice\Auth\Domain;

use CodelyTv\Backoffice\Auth\Domain\AuthPassword;
use CodelyTv\Tests\Shared\Domain\UuidMother;

final class AuthPasswordMother
{
    public static function create(string $value): AuthPassword
    {
        return new AuthPassword($value);
    }

    public static function random(): AuthPassword
    {
        return self::create(UuidMother::random());
    }
}
