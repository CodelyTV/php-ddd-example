<?php


namespace CodelyTv\Tests\Backoffice\Videos\Application\Update;


use CodelyTv\Backoffice\Videos\Application\Update\VideoTitleUpdater;
use CodelyTv\Backoffice\Videos\Domain\VideoId;
use CodelyTv\Backoffice\Videos\Domain\VideoNotExist;
use CodelyTv\Tests\Backoffice\Videos\Domain\VideoMother;
use CodelyTv\Tests\Backoffice\Videos\VideosModuleUnitTestCase;

final class VideoTitleUpdaterTest extends VideosModuleUnitTestCase
{
    private VideoTitleUpdater $videoTitleUpdater;

    protected function setUp(): void
    {
        $this->videoTitleUpdater = new VideoTitleUpdater($this->repository());
    }

    /** @test */
    public function should_update_a_video_when_video_exists(): void
    {
        $video = VideoMother::random();
        $updatedVideo = VideoMother::createWithId($video->id());
        $request = VideoTitleUpdaterRequestMother::createFrom($updatedVideo);
        $this->shouldSearch($video->id(), $video);
        $this->shouldUpdate($updatedVideo);
        $this->videoTitleUpdater->__invoke($request);
    }

    /** @test */
    public function should_fail_when_video_does_not_exist(): void
    {
        $this->expectException(VideoNotExist::class);
        $request = VideoTitleUpdaterRequestMother::random();
        $this->shouldSearch(new VideoId($request->videoId()), null);
        $this->videoTitleUpdater->__invoke($request);
    }

}