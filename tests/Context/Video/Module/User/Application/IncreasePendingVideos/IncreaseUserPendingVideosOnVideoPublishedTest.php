<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Application\IncreasePendingVideos;

use CodelyTv\Context\Video\Module\User\Application\IncreasePendingVideos\IncreaseUserTotalVideosCreatedOnVideoCreated;
use CodelyTv\Context\Video\Module\User\Application\IncreasePendingVideos\UserTotalVideosCreatedIncreaser;
use CodelyTv\Test\Context\Video\Module\User\UserModuleUnitTestCase;
use CodelyTv\Test\Context\Video\Module\User\Domain\ScalaVideoCreatedDomainEventStub;
use CodelyTv\Test\Context\Video\Module\User\Domain\TotalVideosCreatedStub;
use CodelyTv\Test\Context\Video\Module\User\Domain\UserIdStub;
use CodelyTv\Test\Context\Video\Module\User\Domain\UserStub;
use CodelyTv\Test\Shared\Domain\DuplicatorStub;

final class IncreaseUserPendingVideosOnVideoPublishedTest extends UserModuleUnitTestCase
{
    /** @var IncreaseUserTotalVideosCreatedOnVideoCreated */
    private $subscriber;

    protected function setUp()
    {
        parent::setUp();

        $increaser = new UserTotalVideosCreatedIncreaser($this->repository());

        $this->subscriber = new IncreaseUserTotalVideosCreatedOnVideoCreated($increaser);
    }

    /** @test */
    public function it_should_increase_user_total_videos_created_on_scala_video_created()
    {
        $event = ScalaVideoCreatedDomainEventStub::random();

        $id = UserIdStub::create($event->creatorId());
        $user = UserStub::withId($id);

        $updatedUser = DuplicatorStub::with(
            $user,
            ['totalVideosCreated' => TotalVideosCreatedStub::create($user->totalVideosCreated()->value() + 1)]
        );

        $this->shouldSearchUser($id, $user);
        $this->shouldSaveUser($updatedUser);

        $this->notify($event, $this->subscriber);
    }
}
