<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\User\Infrastructure\Persistence;

use CodelyTv\Mooc\Module\User\Domain\UserRepository;
use CodelyTv\Test\Mooc\Module\User\UserModuleFunctionalTestCase;
use CodelyTv\Test\Mooc\Module\User\Domain\UserIdMother;
use CodelyTv\Test\Mooc\Module\User\Domain\UsersMother;
use CodelyTv\Test\Mooc\Module\User\Domain\UserMother;

final class UserRepositoryTest extends UserModuleFunctionalTestCase
{
    /** @test */
    public function it_should_save_a_video()
    {
        $this->repository()->save(UserMother::random());
    }

    /** @test */
    public function it_should_find_an_existing_video()
    {
        $user = UserMother::random();

        $this->repository()->save($user);
        $this->clearUnitOfWork();

        $this->assertSimilar($user, $this->repository()->search($user->id()));
    }

    /** @test */
    public function it_should_find_multiples_video()
    {
        $user    = UserMother::random();
        $another = UserMother::random();
        $users   = UsersMother::create($user, $another);

        $this->repository()->saveAll($users);
        $this->clearUnitOfWork();

        $this->assertSimilar($users, $this->repository()->all());
    }

    /** @test */
    public function it_should_not_find_a_non_existing_video()
    {
        $this->assertNull($this->repository()->search(UserIdMother::random()));
    }

    private function repository(): UserRepository
    {
        return $this->service('codely.mooc.user.repository');
    }
}
