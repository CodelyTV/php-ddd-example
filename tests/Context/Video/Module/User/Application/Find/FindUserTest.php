<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Application\Find;

use CodelyTv\Context\Video\Module\User\Application\Find\FindUserQueryHandler;
use CodelyTv\Context\Video\Module\User\Application\Find\UserFinder;
use CodelyTv\Context\Video\Module\User\Domain\UserNotExist;
use CodelyTv\Test\Context\Video\Module\User\UserModuleUnitTestCase;
use CodelyTv\Test\Context\Video\Module\User\Domain\UserIdStub;
use CodelyTv\Test\Context\Video\Module\User\Domain\UserResponseStub;
use CodelyTv\Test\Context\Video\Module\User\Domain\UserStub;

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
        $query = FindUserQueryStub::random();

        $id   = UserIdStub::create($query->id());
        $user = UserStub::withId($id);

        $response = UserResponseStub::create($user->id(), $user->name(), $user->totalVideosCreated());

        $this->shouldSearchUser($id, $user);

        $this->assertAskResponse($query, $response, $this->handler);
    }

    /** @test */
    public function it_should_throw_an_exception_finding_a_non_existing_user()
    {
        $query = FindUserQueryStub::random();

        $id = UserIdStub::create($query->id());

        $this->shouldSearchUser($id);

        $this->assertAskThrowsException(UserNotExist::class, $query, $this->handler);
    }
}
