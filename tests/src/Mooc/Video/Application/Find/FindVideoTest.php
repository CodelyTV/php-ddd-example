<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Video\Application\Find;

use CodelyTv\Mooc\Video\Application\Find\FindVideoQueryHandler;
use CodelyTv\Mooc\Video\Application\Find\VideoFinder;
use CodelyTv\Mooc\Video\Domain\VideoNotFound;
use CodelyTv\Test\Mooc\Video\Domain\VideoIdMother;
use CodelyTv\Test\Mooc\Video\Domain\VideoMother;
use CodelyTv\Test\Mooc\Video\VideoModuleUnitTestCase;

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
    public function it_should_find_an_existing_video()
    {
        $query = FindVideoQueryMother::random();

        $id = VideoIdMother::create($query->id());
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
    public function it_should_throw_an_exception_finding_a_non_existing_video()
    {
        $query = FindVideoQueryMother::random();

        $id = VideoIdMother::create($query->id());

        $this->shouldSearchVideo($id);

        $this->assertAskThrowsException(VideoNotFound::class, $query, $this->handler);
    }
}
