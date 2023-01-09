<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\LastVideo\Application\Find;

use CodelyTv\Mooc\LastVideo\Application\Find\LastVideoFinder;
use CodelyTv\Mooc\LastVideo\Application\Find\FindLastVideoQuery;
use CodelyTv\Mooc\LastVideo\Application\Find\FindLastVideoQueryHandler;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoNotExist;
use CodelyTv\Tests\Mooc\LastVideo\LastVideoModuleUnitTestCase;
use CodelyTv\Tests\Mooc\LastVideo\Domain\LastVideoMother;

final class FindLastVideoQueryHandlerTest extends LastVideoModuleUnitTestCase
{
    private FindLastVideoQueryHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new FindLastVideoQueryHandler(new LastVideoFinder($this->repository()));
    }

    /** @test */
    public function it_should_find_an_existing_last_video(): void
    {
        $lastVideo  = LastVideoMother::create();
        $query    = new FindLastVideoQuery();
        $response = LastVideoResponseMother::create($lastVideo->videoId(), $lastVideo->type(), $lastVideo->title(), $lastVideo->url(), $lastVideo->courseId());

        $this->shouldSearch($lastVideo);

        $this->assertAskResponse($response, $query, $this->handler);
    }

    /** @test */
    public function it_should_throw_an_exception_when_last_video_does_not_exists(): void
    {
        $query = new FindLastVideoQuery();

        $this->shouldSearch(null);

        $this->assertAskThrowsException(LastVideoNotExist::class, $query, $this->handler);
    }
}
