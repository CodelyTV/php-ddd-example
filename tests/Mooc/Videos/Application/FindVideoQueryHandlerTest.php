<?php

namespace CodelyTv\Tests\Mooc\Videos\Application;

use CodelyTv\Mooc\Videos\Application\Find\FindVideoQuery;
use CodelyTv\Mooc\Videos\Application\Find\FindVideoQueryHandler;
use CodelyTv\Mooc\Videos\Application\Find\VideoFinder;
use CodelyTv\Mooc\Videos\Application\Find\VideoResponse;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoResponseMother;
use CodelyTv\Tests\Mooc\Videos\VideoRepositoryModuleUnitTest;

class FindVideoQueryHandlerTest extends VideoRepositoryModuleUnitTest
{
    private FindVideoQueryHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new FindVideoQueryHandler(new VideoFinder($this->repository()));
    }

    /** @test */
    public function it_should_find_an_existing_video(): void
    {
        $videoId = new VideoId(VideoId::random()->value());
        $video = VideoMother::lovelyVideo($videoId);
        $expected = VideoResponseMother::lovelyVideoResponse($video);

        $query = new FindVideoQuery($videoId->value());

        $this->repositoryFindAVideoWhenVideoidIsSearched($videoId, $video);

        $got = $this->executeHandler($query);
        self::assertEquals($expected, $got);
    }

    public function executeHandler(FindVideoQuery $query): VideoResponse
    {
        return ($this->handler)($query);
    }
}
