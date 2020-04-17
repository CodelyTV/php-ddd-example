<?php


namespace CodelyTv\Tests\Mooc\Videos\Application\Update;


use CodelyTv\Mooc\Videos\Application\Update\VideoTitleUpdater;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoMother;
use CodelyTv\Tests\Mooc\Videos\VideosModuleUnitTestCase;

final class VideoTitleUpdaterTest extends VideosModuleUnitTestCase
{
    private VideoTitleUpdater $videoTitleUpdater;

    protected function setUp(): void
    {
        $this->videoTitleUpdater = new VideoTitleUpdater($this->repository());
    }

    /** @test */
    public function should_update_the_video_when_title_is_passed(): void
    {
        $video = VideoMother::random();
        $this->shouldSearch($video);
        $updatedVideo = VideoMother::createWithId($video->id());
        $this->shouldUpdate($updatedVideo);
        $this->videoTitleUpdater->__invoke($video->id()->value(), $updatedVideo->title()->value());
    }

}