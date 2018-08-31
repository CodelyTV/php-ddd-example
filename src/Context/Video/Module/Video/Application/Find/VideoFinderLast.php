<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\Video\Application\Find;

use CodelyTv\Context\Video\Module\Video\Domain\VideoRepositoryLast;
use CodelyTv\Context\Video\Module\Video\Domain\VideoFinderLast as DomainVideoFinderLast;

final class VideoFinderLast
{
    private $finder;

    public function __construct(VideoRepositoryLast $repository)
    {
        $this->finder = new DomainVideoFinderLast($repository);
    }

    public function __invoke()
    {
        return $this->finder->__invoke();
    }
}
