<?php

namespace CodelyTv\Tests\Mooc\Videos;

use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class VideoRepositoryModuleUnitTest extends UnitTestCase
{
    private VideoRepository|MockInterface $repository;

    protected function repositoryFindAVideoWhenVideoidIsSearched(VideoId $videoId, ?Video $video): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->once()
            ->andReturn($video);
    }

    protected function repository(): VideoRepository|MockInterface
    {
        return $this->repository = $this->repository ?? $this->mock(VideoRepository::class);
    }
}
