<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Videos\Application\Find;

use CodelyTv\Mooc\Videos\Application\Find\FindVideoQueryHandler;
use CodelyTv\Mooc\Videos\Application\Find\VideoFinder;
use CodelyTv\Mooc\Videos\Domain\VideoNotFound;
use CodelyTv\Test\Mooc\Videos\Domain\VideoIdMother;
use CodelyTv\Test\Mooc\Videos\Domain\VideoMother;
use CodelyTv\Test\Mooc\Videos\VideoModuleUnitTestCase;

final class FindVideoTest extends VideoModuleUnitTestCase
{
    /** @var FindVideoQueryHandler */
    private $handler;

    protected function setUp()
    {
        parent::setUp();

        $finder = new VideoFinder($this->repository());

        $this->handler = new FindVideoQueryHandler($finder);
    }

    /** @test */
    public function it_should_find_an_existing_video(): void
    {
        $query = FindVideoQueryMother::random();

        $id    = VideoIdMother::create($query->id());
        $video = VideoMother::withId($id);

        $response = VideoResponseMother::create(
            $video->id(),
            $video->type(),
            $video->title(),
            $video->url(),
            $video->courseId()
        );

        $this->shouldSearchVideo($id, $video);

        $this->assertAskResponse($query, $response, $this->handler);
    }

    /** @test */
    public function it_should_throw_an_exception_finding_a_non_existing_video(): void
    {
        $query = FindVideoQueryMother::random();

        $id = VideoIdMother::create($query->id());

        $this->shouldSearchVideo($id);

        $this->assertAskThrowsException(VideoNotFound::class, $query, $this->handler);
    }
}
