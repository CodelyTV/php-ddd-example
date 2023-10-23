<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Backoffice\Auth\Domain;

use CodelyTv\Backoffice\Auth\Domain\AuthUsername;
use CodelyTv\Tests\Shared\Domain\WordMother;

final class AuthUsernameMother
{
	public static function create(?string $value = null): AuthUsername
	{
		return new AuthUsername($value ?? WordMother::create());
	}
}
