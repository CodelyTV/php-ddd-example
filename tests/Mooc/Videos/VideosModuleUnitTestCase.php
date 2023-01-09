<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos;

use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoId;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class VideosModuleUnitTestCase extends UnitTestCase
{
    private VideoRepository|MockInterface|null $repository;

    protected function shouldSave(Video $Video): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with($this->similarTo($Video))
            ->once()
            ->andReturnNull();
    }

    protected function shouldSearch(VideoId $id, ?Video $Video): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->with($this->similarTo($id))
            ->once()
            ->andReturn($Video);
    }

    protected function repository(): VideoRepository|MockInterface
    {
        return $this->repository = $this->repository ?? $this->mock(VideoRepository::class);
    }
}
