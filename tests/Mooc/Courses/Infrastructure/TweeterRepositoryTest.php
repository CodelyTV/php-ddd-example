<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Infrastructure;

use CodelyTv\Tests\Mooc\Courses\CoursesModuleInfrastructureTestCase;


class TweeterRepositoryTest extends CoursesModuleInfrastructureTestCase
{
    /** @test */
    public function it_should_send_a_tweet(): void
    {
        
        $twitter_message = $this->notifier()->publish("Message sent!");
        $this->assertEquals("Message sent!", $twitter_message);
    }

}
