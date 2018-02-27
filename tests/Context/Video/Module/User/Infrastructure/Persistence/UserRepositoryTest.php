<?php

namespace CodelyTv\Test\Context\Video\Module\User\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\User\Domain\UserRepository;
use CodelyTv\Test\Context\Video\Module\User\UserModuleFunctionalTestCase;
use CodelyTv\Test\Context\Video\Module\User\Domain\UserIdStub;
use CodelyTv\Test\Context\Video\Module\User\Domain\UsersStub;
use CodelyTv\Test\Context\Video\Module\User\Domain\UserStub;

final class UserRepositoryTest extends UserModuleFunctionalTestCase
{
    /** @test */
    public function it_should_save_a_video()
    {
        $this->repository()->save(UserStub::random());
    }

    /** @test */
    public function it_should_find_an_existing_video()
    {
        $user = UserStub::random();

        $this->repository()->save($user);
        $this->clearUnitOfWork();

        $this->assertSimilar($user, $this->repository()->search($user->id()));
    }

    /** @test */
    public function it_should_find_multiples_video()
    {
        $user    = UserStub::random();
        $another = UserStub::random();
        $users   = UsersStub::create($user, $another);

        $this->repository()->saveAll($users);
        $this->clearUnitOfWork();

        $this->assertSimilar($users, $this->repository()->all());
    }

    /** @test */
    public function it_should_not_find_a_non_existing_video()
    {
        $this->assertNull($this->repository()->search(UserIdStub::random()));
    }

    private function repository(): UserRepository
    {
        return $this->service('codely.video.user.repository');
    }
}
