<?php

namespace CodelyTv\Context\Video\Module\Video\Tests\Infrastructure;

use CodelyTv\Context\Video\Module\Video\Domain\VideoRepository;
use CodelyTv\Context\Video\Module\Video\Test\PhpUnit\VideoModuleFunctionalTestCase;
use CodelyTv\Context\Video\Module\Video\Test\Stub\VideoIdStub;
use CodelyTv\Context\Video\Module\Video\Test\Stub\VideoStub;

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
