<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\User\Application\Find;

use CodelyTv\Mooc\User\Application\Find\FindUserQueryHandler;
use CodelyTv\Mooc\User\Application\Find\UserFinder;
use CodelyTv\Mooc\User\Domain\UserNotExist;
use CodelyTv\Test\Mooc\User\UserModuleUnitTestCase;
use CodelyTv\Test\Mooc\User\Domain\UserIdMother;
use CodelyTv\Test\Mooc\User\Domain\UserResponseMother;
use CodelyTv\Test\Mooc\User\Domain\UserMother;

final class FindUserTest extends UserModuleUnitTestCase
{
    /** @var FindUserQueryHandler */
    private $handler;

    protected function setUp()
    {
        parent::setUp();

        $finder = new UserFinder($this->repository());

        $this->handler = new FindUserQueryHandler($finder);
    }

    /** @test */
    public function it_should_find_an_existing_user()
    {
        $query = FindUserQueryMother::random();

        $id   = UserIdMother::create($query->id());
        $user = UserMother::withId($id);

        $response = UserResponseMother::create($user->id(), $user->name(), $user->totalVideosCreated());

        $this->shouldSearchUser($id, $user);

        $this->assertAskResponse($query, $response, $this->handler);
    }

    /** @test */
    public function it_should_throw_an_exception_finding_a_non_existing_user()
    {
        $query = FindUserQueryMother::random();

        $id = UserIdMother::create($query->id());

        $this->shouldSearchUser($id);

        $this->assertAskThrowsException(UserNotExist::class, $query, $this->handler);
    }
}
