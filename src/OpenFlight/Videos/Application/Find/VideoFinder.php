<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Videos\Application\Find;

use CodelyTv\OpenFlight\Videos\Domain\VideoFinder as DomainVideoFinder;
use CodelyTv\OpenFlight\Videos\Domain\VideoId;
use CodelyTv\OpenFlight\Videos\Domain\VideoRepository;

final class VideoFinder
{
    private DomainVideoFinder $finder;

    public function __construct(VideoRepository $repository)
    {
        $this->finder = new DomainVideoFinder($repository);
    }

    public function __invoke(VideoId $id)
    {
        return $this->finder->__invoke($id);
    }
}
