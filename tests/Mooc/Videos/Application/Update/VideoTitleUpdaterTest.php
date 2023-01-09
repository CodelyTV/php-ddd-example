<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Videos\Application\Update\VideoTitleUpdater;
use CodelyTv\Mooc\Videos\Domain\VideoNotFound;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoTitleMother;
use CodelyTv\Tests\Mooc\Videos\VideosModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoIdMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoMother;
use CodelyTv\Tests\Shared\Domain\DuplicatorMother;

final class VideoTitleUpdaterTest extends VideosModuleUnitTestCase
{
    private VideoTitleUpdater|null $titleUpdater;

    protected function setUp(): void
    {
        parent::setUp();

        $this->titleUpdater = new VideoTitleUpdater($this->repository());
    }

    /** @test */
    public function it_should_change_the_title_of_an_existing_Video(): void
    {
        $Video        = VideoMother::create();
        $newTitle       = VideoTitleMother::create();
        $titleChangedVideo = DuplicatorMother::with($Video, ['title' => $newTitle]);

        $this->shouldSearch($Video->id(), $Video);
        $this->shouldSave($titleChangedVideo);

        $this->titleUpdater->__invoke($Video->id(), $newTitle);
    }

    /** @test */
    public function it_should_throw_an_exception_when_the_Video_not_exist(): void
    {
        $this->expectException(VideoNotFound::class);

        $id = VideoIdMother::create();

        $this->shouldSearch($id, null);

        $this->titleUpdater->__invoke($id, VideoTitleMother::create());
    }
}
