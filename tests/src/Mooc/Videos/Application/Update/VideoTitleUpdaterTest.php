<?php


namespace CodelyTv\Tests\Mooc\Videos\Application\Update;


use CodelyTv\Mooc\Videos\Application\Update\VideoTitleUpdater;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoNotExist;
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
    public function should_update_a_video_when_video_exists(): void
    {
        $video = VideoMother::random();
        $updatedVideo = VideoMother::createWithId($video->id());
        $request = VideoTitleUpdaterRequestMother::create($video->id()->value(), $updatedVideo->title()->value());
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