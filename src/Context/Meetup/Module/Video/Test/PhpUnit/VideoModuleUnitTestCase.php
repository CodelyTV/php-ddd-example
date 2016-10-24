<?php

namespace CodelyTv\Context\Meetup\Module\Video\Test\PhpUnit;

use CodelyTv\Context\Meetup\Module\Video\Domain\Video;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoRepository;
use CodelyTv\Context\Meetup\Test\PhpUnit\MeetupContextUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\similarTo;

abstract class VideoModuleUnitTestCase extends MeetupContextUnitTestCase
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
