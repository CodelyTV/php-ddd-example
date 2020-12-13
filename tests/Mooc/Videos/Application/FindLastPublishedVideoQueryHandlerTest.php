<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Application;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Application\Find\FindLastPublishedVideoQuery;
use CodelyTv\Mooc\Videos\Application\Find\FindLastPublishedVideoQueryHandler;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Mooc\Videos\Infrastructure\Persistence\VideoRepositoryInMemory;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

final class FindLastPublishedVideoQueryHandlerTest extends UnitTestCase
{
    /** @test */
    public function returnLastPublishedVideo(): void
    {
        $videoRepositoryInMemory = new VideoRepositoryInMemory();
        $videoToSave = $this->createVideoToSave();
        $videoRepositoryInMemory->save($videoToSave);

        $query = new FindLastPublishedVideoQuery();
        $handler = new FindLastPublishedVideoQueryHandler($videoRepositoryInMemory);

        $videoReturned = $handler->__invoke($query);

        $this->assertSame($videoToSave->id(), $videoReturned->id());
    }

    private function createVideoToSave() : Video
    {
        return Video::create(
            VideoId::random(),
            VideoType::fromString(VideoType::SCREENCAST),
            new VideoTitle('in memory video'),
            new VideoUrl('https://www.video-url.com/in-memory-1'),
            CourseId::random()
        );
    }
}
