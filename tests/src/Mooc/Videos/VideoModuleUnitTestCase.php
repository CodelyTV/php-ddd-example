<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Videos;

use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Test\Mooc\Shared\Infrastructure\MoocContextUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\Shared\equalTo;
use function CodelyTv\Test\Shared\similarTo;

abstract class VideoModuleUnitTestCase extends MoocContextUnitTestCase
{
    private $repository;

    /** @return VideoRepository|MockInterface */
    protected function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(VideoRepository::class);
    }

    protected function shouldSaveVideo(Video $video): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(similarTo($video))
            ->once()
            ->andReturnNull();
    }

    protected function shouldSearchVideo(VideoId $id, Video $video = null): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->with(equalTo($id))
            ->once()
            ->andReturn($video);
    }
}
