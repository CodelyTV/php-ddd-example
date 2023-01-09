<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\LastVideo;

use CodelyTv\Mooc\LastVideo\Domain\LastVideo;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoRepository;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class LastVideoModuleUnitTestCase extends UnitTestCase
{
    private LastVideoRepository|MockInterface|null $repository;

    protected function shouldSave(LastVideo $lastVideo): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->once()
            ->with($this->similarTo($lastVideo))
            ->andReturnNull();
    }

    protected function shouldSearch(?LastVideo $lastVideo): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->once()
            ->andReturn($lastVideo);
    }

    protected function repository(): LastVideoRepository|MockInterface
    {
        return $this->repository = $this->repository ?? $this->mock(LastVideoRepository::class);
    }
}
