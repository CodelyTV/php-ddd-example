<?php


namespace CodelyTv\Tests\Mooc\Videos;


use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class VideosModuleUnitTestCase extends UnitTestCase
{
    private $repository;

    /** @return VideoRepository|MockInterface */
    protected function repository(): MockInterface
    {
        return $this->repository = $this->repository ?: $this->mock(VideoRepository::class);
    }

    protected function shouldSearch(VideoId $videoId, ?Video $video)
    {
        $this->repository()
            ->shouldReceive('search')
            ->with($this->similarTo($videoId))
            ->once()
            ->andReturn($video);
    }

    protected function shouldUpdate(Video $updatedVideo)
    {
        $this->repository()
            ->shouldReceive('update')
            ->with($this->similarTo($updatedVideo))
            ->once();
    }
}