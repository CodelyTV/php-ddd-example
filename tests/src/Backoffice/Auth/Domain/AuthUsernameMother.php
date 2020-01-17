<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Backoffice\Auth\Domain;

use CodelyTv\Backoffice\Auth\Domain\AuthUsername;
use CodelyTv\Tests\Shared\Domain\WordMother;

final class AuthUsernameMother
{
    public static function create(string $value): AuthUsername
    {
        return new AuthUsername($value);
    }

    public static function random(): AuthUsername
    {
        return self::create(WordMother::random());
    }
}
