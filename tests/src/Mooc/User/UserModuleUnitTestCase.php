<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\User;

use CodelyTv\Mooc\User\Domain\User;
use CodelyTv\Mooc\User\Domain\UserId;
use CodelyTv\Mooc\User\Domain\UserRepository;
use CodelyTv\Test\Mooc\Shared\Infrastructure\MoocContextUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\similarTo;
use function CodelyTv\Test\equalTo;

abstract class UserModuleUnitTestCase extends MoocContextUnitTestCase
{
    private $repository;

    /** @return UserRepository|MockInterface */
    protected function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(UserRepository::class);
    }

    protected function shouldSaveUser(User $user)
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(similarTo($user))
            ->once()
            ->andReturnNull();
    }

    protected function shouldSearchUser(UserId $id, User $user = null)
    {
        $this->repository()
            ->shouldReceive('search')
            ->with(equalTo($id))
            ->once()
            ->andReturn($user);
    }
}
