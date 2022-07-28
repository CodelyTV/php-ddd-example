<?php

declare (strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Application\FindLast;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Application\FindLast\FindLastQuery;
use CodelyTv\Mooc\Videos\Application\FindLast\FindLastQueryHandler;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\Videos;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FindLastQueryHandlerTest extends TestCase
{
    private MockObject|VideoRepository $videoRepository;
    private FindLastQueryHandler $queryHandler;

    protected function setUp(): void
    {
        $this->videoRepository = $this->createMock(VideoRepository::class);
        $this->queryHandler = new FindLastQueryHandler($this->videoRepository);
    }

    public function testMustReturnNullGivenRepositoryWithoutVideos(): void
    {
        $this->videoRepository->expects(self::once())->method('searchByCriteria')->willReturn(new Videos([]));

        $video = $this->queryHandler->__invoke(new FindLastQuery());

        self::assertNull($video);
    }

    public function testMustReturnLastVideoGivenRepositoryWithVideos(): void
    {
        $video1 = Video::create(
            VideoId::random(),
            VideoType::interview(),
            new VideoTitle('my video1 title'),
            new VideoUrl('https://myvdeo1url.com'),
            CourseId::random()
        );
        $video2 = Video::create(
            VideoId::random(),
            VideoType::interview(),
            new VideoTitle('my video2 title'),
            new VideoUrl('https://myvdeo2url.com'),
            CourseId::random()
        );
        $this->videoRepository->expects(self::once())->method('searchByCriteria')->willReturn(new Videos([$video1, $video2]));

        $video = $this->queryHandler->__invoke(new FindLastQuery());
        self::assertSame($video, $video1);
    }


}
