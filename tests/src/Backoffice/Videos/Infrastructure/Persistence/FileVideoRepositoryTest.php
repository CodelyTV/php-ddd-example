<?php

namespace CodelyTv\Tests\Backoffice\Videos\Infrastructure\Persistence;

use CodelyTv\Backoffice\Videos\Domain\VideoId;
use CodelyTv\Tests\Backoffice\Videos\Domain\VideoMother;

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
    public function should_save_a_video()
    {
        $video = VideoMother::random();
        $this->repository()->save($video);
        $this->assertSimilar($video, $this->repository()->search($video->id()));
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

    /** @test */
    public function should_not_create_a_video_when_updating_if_the_video_does_not_exist()
    {
        $video = VideoMother::random();
        $this->repository()->save($video);
        $this->repository()->save(VideoMother::random());
        $nonExistingVideo = VideoMother::random();
        $this->repository()->update($nonExistingVideo);
        $this->assertEquals(null, $this->repository()->search($nonExistingVideo->id()));
    }
}
