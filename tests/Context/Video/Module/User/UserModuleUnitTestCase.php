<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\User;

use CodelyTv\Context\Video\Module\User\Domain\User;
use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Context\Video\Module\User\Domain\UserRepository;
use CodelyTv\Test\Context\Video\VideoContextUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\similarTo;
use function CodelyTv\Test\equalTo;

abstract class UserModuleUnitTestCase extends VideoContextUnitTestCase
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
