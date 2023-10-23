<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Backoffice\Auth\Domain;

use CodelyTv\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use CodelyTv\Backoffice\Auth\Domain\AuthPassword;
use CodelyTv\Backoffice\Auth\Domain\AuthUser;
use CodelyTv\Backoffice\Auth\Domain\AuthUsername;

final class AuthUserMother
{
	public static function create(?AuthUsername $username = null, ?AuthPassword $password = null): AuthUser
	{
		return new AuthUser($username ?? AuthUsernameMother::create(), $password ?? AuthPasswordMother::create());
	}

	public static function fromCommand(AuthenticateUserCommand $command): AuthUser
	{
		return self::create(
			AuthUsernameMother::create($command->username()),
			AuthPasswordMother::create($command->password())
		);
	}
}
