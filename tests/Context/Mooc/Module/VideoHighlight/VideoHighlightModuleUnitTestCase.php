<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Mooc\Module\VideoHighlight;

use CodelyTv\Context\Mooc\Module\VideoHighlight\Domain\VideoHighlightRepository;
use CodelyTv\Test\Context\Mooc\MoocContextUnitTestCase;
use Mockery\MockInterface;

abstract class VideoHighlightModuleUnitTestCase extends MoocContextUnitTestCase
{
    private $repository;

    /** @return VideoHighlightRepository|MockInterface */
    protected function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(VideoHighlightRepository::class);
    }
}
