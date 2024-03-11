<?php

namespace CodelyTv\Tests\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Videos\Application\Find\VideoFinder;
use CodelyTv\Mooc\Videos\Domain\VideoNotFound;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoIdMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoMother;
use CodelyTv\Tests\Mooc\Videos\VideosModuleUnitTestCase;

class VideoRenamerCommandTest extends VideosModuleUnitTestCase
{
    private VideoFinder|null $finder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->finder = new VideoFinder($this->repository());
    }

    /** @test */
    public function it_should_throw_an_exception_when_the_video_not_exist()
    {
        $this->expectException(VideoNotFound::class);

        $id = VideoIdMother::create();

        $this->shouldSearch($id, null);

        $this->finder->__invoke($id);
    }

    /** @test */
    public function it_should_find_an_existing_video(): void
    {
        $video = VideoMother::create();

        $this->shouldSearch($video->id(), $video);

        $videoFromRepository = $this->finder->__invoke($video->id());

        $this->assertEquals($videoFromRepository, $video);
    }
}
