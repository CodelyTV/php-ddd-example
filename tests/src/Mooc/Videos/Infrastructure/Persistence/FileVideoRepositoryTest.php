<?php

namespace CodelyTv\Tests\Mooc\Videos\Infrastructure\Persistence;

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
}
