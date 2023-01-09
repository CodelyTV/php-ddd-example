<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Application\Find;

use CodelyTv\Mooc\Shared\Domain\Videos\VideoId;
use CodelyTv\Mooc\Videos\Application\Find\VideoFinder;
use CodelyTv\Mooc\Videos\Application\Find\FindVideoQuery;
use CodelyTv\Mooc\Videos\Application\Find\FindVideoQueryHandler;
use CodelyTv\Mooc\Videos\Domain\VideoNotFound;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoIdMother;
use CodelyTv\Tests\Mooc\Videos\VideosModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoMother;

final class FindVideoQueryHandlerTest extends VideosModuleUnitTestCase
{
    private FindVideoQueryHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new FindVideoQueryHandler(new VideoFinder($this->repository()));
    }

    /** @test */
    public function it_should_find_an_existing_courses_counter(): void
    {
        $video  = VideoMother::create();
        $query    = new FindVideoQuery($video->id()->value());
        $response = VideoResponseMother::create($video->id(), $video->title(), $video->url(), $video->type(), $video->courseId());

        $this->shouldSearch($video->id(), $video);

        $this->assertAskResponse($response, $query, $this->handler);
    }

    /** @test */
    public function it_should_throw_an_exception_when_courses_counter_does_not_exists(): void
    {
        $query = new FindVideoQuery(VideoIdMother::create()->value());

        $this->shouldSearch(new VideoId($query->id()), null);

        $this->assertAskThrowsException(VideoNotFound::class, $query, $this->handler);
    }
}
