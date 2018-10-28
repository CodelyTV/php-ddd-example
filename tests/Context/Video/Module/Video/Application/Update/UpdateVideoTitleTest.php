<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\Video\Application\Update;

use CodelyTv\Context\Video\Module\Video\Application\Update\UpdateVideoTitleCommandHandler;
use CodelyTv\Context\Video\Module\Video\Application\Update\VideoTitleUpdater;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Test\Context\Video\Module\Video\Application\Find\FindVideoQueryStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoTitleStub;
use CodelyTv\Test\Context\Video\Module\Video\VideoModuleUnitTestCase;

final class UpdateVideoTitleTest extends VideoModuleUnitTestCase
{
    /** @var UpdateVideoTitleCommandHandler */
    private $handler;

    protected function setUp()
    {
        parent::setUp();

        $updater = new VideoTitleUpdater($this->repository());

        $this->handler = new UpdateVideoTitleCommandHandler($updater);
    }

    /** @test */
    public function it_should_update_a_video_title()
    {
        $query = FindVideoQueryStub::random();

        $id = VideoIdStub::create($query->id());
        $video = VideoStub::withId($id);

        $updateVideoTitleCommand = UpdateVideoTitleCommandStub::create(
            Uuid::random(),
            $id,
            VideoTitleStub::random()
        );

        $this->shouldSearchVideo(
            new VideoId($updateVideoTitleCommand->id()),
            $video
        );
        $this->shouldSaveVideo($video);

        $this->dispatch($updateVideoTitleCommand, $this->handler);
    }
}
