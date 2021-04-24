<?php

namespace CodelyTv\Tests\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Videos\Application\Update\UpdateVideoTitleCommandHandler;
use CodelyTv\Mooc\Videos\Application\Update\VideoTitleUpdater;
use CodelyTv\Mooc\Videos\Domain\VideoNotFound;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoIdMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoTitleMother;
use CodelyTv\Tests\Mooc\Videos\Infrastructure\VideosModuleUnitTestCase;
use CodelyTv\Tests\Shared\Domain\DuplicatorMother;

final class UpdateVideoTitleCommandHandlerTest extends VideosModuleUnitTestCase
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


    /** @test */
    public function it_should_throw_an_exception_when_the_video_does_not_exist(): void
    {
        $this->expectException(VideoNotFound::class);

        $id      = VideoIdMother::create();
        $command = UpdateVideoTitleCommandMother::withId($id);

        $this->shouldSearch($id, null);

        $this->handler->__invoke($command);
    }

}
