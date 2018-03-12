<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Video;

use CodelyTv\Context\Video\Module\Video\Domain\Video;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoRepository;
use CodelyTv\Test\Context\Video\VideoContextUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\similarTo;
use function CodelyTv\Test\equalTo;

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
            ->andReturnNull();
    }

    protected function shouldSearchVideo(VideoId $id, Video $video = null)
    {
        $this->repository()
            ->shouldReceive('search')
            ->with(equalTo($id))
            ->once()
            ->andReturn($video);
    }
}
