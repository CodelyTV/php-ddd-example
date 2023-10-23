<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Auth\Domain;

final readonly class AuthUser
{
	public function __construct(private AuthUsername $username, private AuthPassword $password) {}

	public function passwordMatches(AuthPassword $password): bool
	{
		return $this->password->isEquals($password);
	}

	public function username(): AuthUsername
	{
		return $this->username;
	}
}
