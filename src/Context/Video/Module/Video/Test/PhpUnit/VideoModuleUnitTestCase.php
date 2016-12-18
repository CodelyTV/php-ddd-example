<?php

namespace CodelyTv\Context\Video\Module\Video\Test\PhpUnit;

use CodelyTv\Context\Video\Module\Video\Domain\Video;
use CodelyTv\Context\Video\Module\Video\Domain\VideoRepository;
use CodelyTv\Context\Video\Test\PhpUnit\VideoContextUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\similarTo;

abstract class VideoModuleUnitTestCase extends VideoContextUnitTestCase
{
    private $repository;

    /** @return VideoRepository|MockInterface */
    protected function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(VideoRepository::class);
    }

    protected function shouldSaveVideo(Video $video)
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(similarTo($video))
            ->once()
            ->andReturn($video);
    }
}
