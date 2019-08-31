<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Mooc\Videos\Domain\VideoLastPublishedFinder as DomainVideoLastPublishedFinder;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

final class VideoLastPublishedFinder
{
    private $finder;

    public function __construct(VideoRepository $repository)
    {
        $this->finder = new DomainVideoLastPublishedFinder($repository);
    }

    public function __invoke()
    {
        return $this->finder->__invoke();
    }
}
