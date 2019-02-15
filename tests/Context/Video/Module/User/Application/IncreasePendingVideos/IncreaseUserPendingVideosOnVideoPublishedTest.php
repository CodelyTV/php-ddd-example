<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Application\IncreasePendingVideos;

use CodelyTv\Context\Mooc\Module\User\Application\IncreasePendingVideos\IncreaseUserTotalVideosCreatedOnVideoCreated;
use CodelyTv\Context\Mooc\Module\User\Application\IncreasePendingVideos\UserTotalVideosCreatedIncreaser;
use CodelyTv\Test\Context\Video\Module\User\UserModuleUnitTestCase;
use CodelyTv\Test\Context\Video\Module\User\Domain\ScalaVideoCreatedDomainEventMother;
use CodelyTv\Test\Context\Video\Module\User\Domain\TotalVideosCreatedMother;
use CodelyTv\Test\Context\Video\Module\User\Domain\UserIdMother;
use CodelyTv\Test\Context\Video\Module\User\Domain\UserMother;
use CodelyTv\Test\Shared\Domain\DuplicatorMother;

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
        $event = ScalaVideoCreatedDomainEventMother::random();

        $id = UserIdMother::create($event->creatorId());
        $user = UserMother::withId($id);

        $updatedUser = DuplicatorMother::with(
            $user,
            ['totalVideosCreated' => TotalVideosCreatedMother::create($user->totalVideosCreated()->value() + 1)]
        );

        $this->shouldSearchUser($id, $user);
        $this->shouldSaveUser($updatedUser);

        $this->notify($event, $this->subscriber);
    }
}
