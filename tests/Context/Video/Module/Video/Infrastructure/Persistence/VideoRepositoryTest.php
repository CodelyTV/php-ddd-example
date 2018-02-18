<?php

namespace CodelyTv\Test\Context\Video\Module\Video\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\Video\Domain\VideoRepository;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoStub;
use CodelyTv\Test\Context\Video\Module\Video\VideoModuleFunctionalTestCase;

final class VideoRepositoryTest extends VideoModuleFunctionalTestCase
{
    /** @test */
    public function it_should_save_a_video()
    {
        $this->repository()->save(VideoStub::random());
    }

    /** @test */
    public function it_should_find_an_existing_video()
    {
        $video = VideoStub::random();

        $this->repository()->save($video);
        $this->clearUnitOfWork();

        $this->assertSimilar($video, $this->repository()->search($video->id()));
    }

    /** @test */
    public function it_should_not_find_a_non_existing_video()
    {
        $this->assertNull($this->repository()->search(VideoIdStub::random()));
    }

    private function repository(): VideoRepository
    {
        return $this->service('codely.video.video.repository');
    }
}
