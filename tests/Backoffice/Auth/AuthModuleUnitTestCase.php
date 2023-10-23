<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Backoffice\Auth;

use CodelyTv\Backoffice\Auth\Domain\AuthRepository;
use CodelyTv\Backoffice\Auth\Domain\AuthUser;
use CodelyTv\Backoffice\Auth\Domain\AuthUsername;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class AuthModuleUnitTestCase extends UnitTestCase
{
	private AuthRepository|MockInterface|null $repository = null;

	protected function shouldSearch(AuthUsername $username, AuthUser $authUser = null): void
	{
		$this->repository()
			->shouldReceive('search')
			->with($this->similarTo($username))
			->once()
			->andReturn($authUser);
	}

	protected function repository(): AuthRepository|MockInterface
	{
		return $this->repository ??= $this->mock(AuthRepository::class);
	}
}
