<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\Video\Application\Find;

use CodelyTv\Context\Mooc\Module\Video\Application\Find\FindVideoQueryHandler;
use CodelyTv\Context\Mooc\Module\Video\Application\Find\VideoFinder;
use CodelyTv\Context\Mooc\Module\Video\Domain\VideoNotFound;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdMother;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoMother;
use CodelyTv\Test\Context\Video\Module\Video\VideoModuleUnitTestCase;

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
