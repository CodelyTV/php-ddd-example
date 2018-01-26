<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Tests\Behaviour;

use CodelyTv\Context\Video\Module\User\Application\IncreasePendingVideos\IncreaseUserPendingVideosOnVideoPublished;
use CodelyTv\Context\Video\Module\User\Application\IncreasePendingVideos\UserPendingVideosIncreaser;
use CodelyTv\Context\Video\Module\User\Test\PhpUnit\UserModuleUnitTestCase;

final class IncreaseUserPendingVideosOnVideoPublishedTest extends UserModuleUnitTestCase
{
    /** @var IncreaseUserPendingVideosOnVideoPublished */
    private $subscriber;

    protected function setUp()
    {
        parent::setUp();

        $increaser = new UserPendingVideosIncreaser($this->repository());

        $this->subscriber = new IncreaseUserPendingVideosOnVideoPublished($increaser);
    }
    
    /** @test */
    public function it_should_increase_all_users_total_pending_videos_on_video_published()
    {
        
    }
    
}
