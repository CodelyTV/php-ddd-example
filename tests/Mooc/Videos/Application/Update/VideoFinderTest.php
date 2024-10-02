<?php

namespace CodelyTv\Tests\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Videos\Application\Update\UpdateVideoTitleCommandHandler;
use CodelyTv\Mooc\Videos\Application\Update\VideoTitleUpdater;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoTitleMother;
use CodelyTv\Tests\Mooc\Videos\VideosModuleUnitTestCase;
use CodelyTv\Tests\Shared\Domain\DuplicatorMother;

class VideoFinderTest extends VideosModuleUnitTestCase
{
    private UpdateVideoTitleCommandHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new UpdateVideoTitleCommandHandler(new VideoTitleUpdater($this->repository()));
    }

    /** @test */
    public function it_should_update_video_title_when_video_exists(): void
    {
        $video        = VideoMother::create();
        $newTitle     = VideoTitleMother::create();
        $command      = UpdateVideoTitleCommandMother::withIdAndTitle($video->id(), $newTitle);
        $renamedVideo = DuplicatorMother::with($video, ['title' => $newTitle]);

        $this->shouldSearch($video->id(), $video);
        $this->shouldSave($renamedVideo);

        $this->handler->__invoke($command);
    }
}
