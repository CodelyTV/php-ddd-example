<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Backoffice\Auth\Application\Authenticate;

use CodelyTv\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use CodelyTv\Backoffice\Auth\Domain\AuthPassword;
use CodelyTv\Backoffice\Auth\Domain\AuthUsername;
use CodelyTv\Tests\Backoffice\Auth\Domain\AuthPasswordMother;
use CodelyTv\Tests\Backoffice\Auth\Domain\AuthUsernameMother;

final class AuthenticateUserCommandMother
{
	public static function create(
		?AuthUsername $username = null,
		?AuthPassword $password = null
	): AuthenticateUserCommand {
		return new AuthenticateUserCommand(
			$username?->value() ?? AuthUsernameMother::create()->value(),
			$password?->value() ?? AuthPasswordMother::create()->value()
		);
	}
}
