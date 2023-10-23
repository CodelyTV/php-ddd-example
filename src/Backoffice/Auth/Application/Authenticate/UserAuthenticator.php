<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Auth\Application\Authenticate;

use CodelyTv\Backoffice\Auth\Domain\AuthPassword;
use CodelyTv\Backoffice\Auth\Domain\AuthRepository;
use CodelyTv\Backoffice\Auth\Domain\AuthUser;
use CodelyTv\Backoffice\Auth\Domain\AuthUsername;
use CodelyTv\Backoffice\Auth\Domain\InvalidAuthCredentials;
use CodelyTv\Backoffice\Auth\Domain\InvalidAuthUsername;

final readonly class UserAuthenticator
{
	public function __construct(private AuthRepository $repository) {}

	public function authenticate(AuthUsername $username, AuthPassword $password): void
	{
		$auth = $this->repository->search($username);

		if ($auth === null) {
			throw new InvalidAuthUsername($username);
		}

		$this->ensureCredentialsAreValid($auth, $password);
	}

	private function ensureCredentialsAreValid(AuthUser $auth, AuthPassword $password): void
	{
		if (!$auth->passwordMatches($password)) {
			throw new InvalidAuthCredentials($auth->username());
		}
	}
}
