<?php

declare(strict_types=1);

namespace CodelyTv\Test\Mooc\Video\Application\Update;

use CodelyTv\Mooc\Videos\Application\Update\UpdateVideoCommandHandler;
use CodelyTv\Mooc\Videos\Application\Update\UpdateVideoTitleCommand;
use CodelyTv\Mooc\Videos\Application\Update\VideoTitleUpdater;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Test\Mooc\Video\Domain\VideoMother;
use CodelyTv\Test\Mooc\Video\Domain\VideoTitleMother;
use CodelyTv\Test\Mooc\Video\VideoModuleUnitTestCase;

final class VideoUpdateTest extends VideoModuleUnitTestCase
{
    /** @var UpdateVideoCommandHandler */
    private $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $updater = new VideoTitleUpdater($this->repository());

        $this->handler = new UpdateVideoCommandHandler($updater);
    }

    /** @test */
    public function it_should_update_a_video_title()
    {
        $video = VideoMother::random();
        $newTitle = VideoTitleMother::random();

        $command = new UpdateVideoTitleCommand(Uuid::random(), $video->id()->value(), $newTitle->value());

        $this->shouldSearchVideo($video->id(), $video);
        $this->shouldSaveVideo($video);

        $this->handler->__invoke($command);

        $this->assertEquals($newTitle->value(), $video->title()->value());
    }
}