<?php

namespace CodelyTv\Context\Video\Module\Video\Tests\Behaviour;

use CodelyTv\Context\Video\Module\Video\Domain\Find\FindVideoQueryHandler;
use CodelyTv\Context\Video\Module\Video\Domain\Find\VideoFinder;
use CodelyTv\Context\Video\Module\Video\Domain\Find\VideoNotFound;
use CodelyTv\Context\Video\Module\Video\Test\PhpUnit\VideoModuleUnitTestCase;
use CodelyTv\Context\Video\Module\Video\Test\Stub\FindVideoQueryStub;
use CodelyTv\Context\Video\Module\Video\Test\Stub\VideoIdStub;
use CodelyTv\Context\Video\Module\Video\Test\Stub\VideoResponseStub;
use CodelyTv\Context\Video\Module\Video\Test\Stub\VideoStub;

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
        $query = FindVideoQueryStub::random();

        $id    = VideoIdStub::create($query->id());
        $video = VideoStub::withId($id);

        $response = VideoResponseStub::create($video->id(), $video->title(), $video->url(), $video->courseId());

        $this->shouldSearchVideo($id, $video);

        $this->assertAskResponse($query, $response, $this->handler);
    }

    /** @test */
    public function it_should_throw_an_exception_finding_a_non_existing_video()
    {
        $query = FindVideoQueryStub::random();

        $id = VideoIdStub::create($query->id());

        $this->shouldSearchVideo($id);

        $this->assertAskThrowsException(VideoNotFound::class, $query, $this->handler);
    }
}
