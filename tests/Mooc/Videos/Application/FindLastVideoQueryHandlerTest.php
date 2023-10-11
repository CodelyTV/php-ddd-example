<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Application;


use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Application\Find\FindLastVideoQuery;
use CodelyTv\Mooc\Videos\Application\Find\FindLastVideoQueryHandler;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Mooc\Videos\Infrastructure\VideoRepositoryInMemory;
use CodelyTv\Tests\Shared\Domain\UuidMother;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;

final class FindLastVideoQueryHandlerTest extends UnitTestCase
{

    /** @test */
    public function findLastVideo(): void
    {
        $videoRepositoryInMemory = new VideoRepositoryInMemory();
        $videos = $this->createVideos($videoRepositoryInMemory);

        $query = new FindLastVideoQuery();
        $handler = new FindLastVideoQueryHandler($videoRepositoryInMemory);

        $videoReturned = $handler->__invoke($query);

        $this->assertEquals($videos[1]->id(), $videoReturned->id());
    }

    public function createVideos(VideoRepositoryInMemory $videoRepositoryInMemory): array
    {
        $videos[0] = Video::create(
            new VideoId(RamseyUuid::uuid4()->toString()),
            new VideoType(VideoType::SCREENCAST),
            new VideoTitle('Video 1'),
            new VideoUrl('http://www.videos.com/video-1'),
            new CourseId(RamseyUuid::uuid4()->toString())
        );
        $videoRepositoryInMemory->save($videos[0]);

        $videos[1]  = Video::create(
            new VideoId(RamseyUuid::uuid4()->toString()),
            new VideoType(VideoType::SCREENCAST),
            new VideoTitle('Video 2'),
            new VideoUrl('http://www.videos.com/video-2'),
            new CourseId(RamseyUuid::uuid4()->toString())
        );
        $videoRepositoryInMemory->save($videos[1]);

        return $videos;
    }
}