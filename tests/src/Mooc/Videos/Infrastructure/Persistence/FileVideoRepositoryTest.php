<?php

namespace CodelyTv\Tests\Mooc\Videos\Infrastructure\Persistence;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoMother;

final class FileVideoRepositoryTest extends FileVideoModuleInfrastructureTestCase
{
    /** @test */
    public function should_return_a_video_that_exists()
    {
        $video = VideoMother::random();
        $this->repository()->save($video);
        $this->repository()->save(VideoMother::random());
        $this->assertSimilar($video, $this->repository()->search($video->id()));
    }

    /** @test */
    public function should_return_null_when_video_does_not_exist()
    {
        $this->repository()->save(VideoMother::random());
        $this->assertEquals(null, $this->repository()->search(VideoId::random()));
    }

    /** @test */
    public function should_update_a_video_that_exists()
    {
        $video = VideoMother::random();
        $this->repository()->save($video);
        $this->repository()->save(VideoMother::random());
        $updatedVideo = VideoMother::createWithId($video->id());
        $this->repository()->update($updatedVideo);
        $this->assertSimilar($updatedVideo, $this->repository()->search($video->id()));
    }
}
