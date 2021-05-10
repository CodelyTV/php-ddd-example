<?php

declare(strict_types=1);


namespace CodelyTv\Tests\Mooc\Videos\Infrastructure;


use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

class VideosModuleUnitTestCase extends UnitTestCase
{
    private VideoRepository|MockInterface|null $repository;


    protected function shouldSave(Video $video): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with($this->similarTo($video))
            ->once()
            ->andReturnNull();
    }


    protected function shouldSearch(VideoId $id, ?Video $video): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->with($this->similarTo($id))
            ->once()
            ->andReturn($video);
    }

    protected function repository(): VideoRepository|MockInterface
    {
        return $this->repository = $this->repository ?? $this->mock(VideoRepository::class);
    }
}
