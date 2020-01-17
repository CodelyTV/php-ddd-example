<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Backoffice\Auth\Application\Authenticate;

use CodelyTv\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use CodelyTv\Backoffice\Auth\Domain\AuthPassword;
use CodelyTv\Backoffice\Auth\Domain\AuthUsername;
use CodelyTv\Tests\Backoffice\Auth\Domain\AuthPasswordMother;
use CodelyTv\Tests\Backoffice\Auth\Domain\AuthUsernameMother;

final class AuthenticateUserCommandMother
{
    public static function create(AuthUsername $username, AuthPassword $password): AuthenticateUserCommand
    {
        return new AuthenticateUserCommand($username->value(), $password->value());
    }

    public static function random(): AuthenticateUserCommand
    {
        return self::create(AuthUsernameMother::random(), AuthPasswordMother::random());
    }
}
