<?php

namespace CodelyTv\Context\Video\Module\VideoHighlight\Test\PhpUnit;

use CodelyTv\Context\Video\Module\VideoHighlight\Domain\VideoHighlightRepository;
use CodelyTv\Context\Video\Test\PhpUnit\VideoContextUnitTestCase;
use Mockery\MockInterface;

abstract class VideoHighlightModuleUnitTestCase extends VideoContextUnitTestCase
{
    private $repository;

    /** @return VideoHighlightRepository|MockInterface */
    protected function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(VideoHighlightRepository::class);
    }
}
