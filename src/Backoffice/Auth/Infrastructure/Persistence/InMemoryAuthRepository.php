<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Auth\Infrastructure\Persistence;

use CodelyTv\Backoffice\Auth\Domain\AuthPassword;
use CodelyTv\Backoffice\Auth\Domain\AuthRepository;
use CodelyTv\Backoffice\Auth\Domain\AuthUser;
use CodelyTv\Backoffice\Auth\Domain\AuthUsername;

use function Lambdish\Phunctional\get;

final class InMemoryAuthRepository implements AuthRepository
{
	private const USERS = [
		'javi' => 'barbitas',
		'rafa' => 'pelazo',
	];

	public function search(AuthUsername $username): ?AuthUser
	{
		$password = get($username->value(), self::USERS);

		return $password !== null ? new AuthUser($username, new AuthPassword($password)) : null;
	}
}
