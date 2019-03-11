<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Video\Application\Find;

use CodelyTv\Mooc\Video\Domain\VideoRepository;
use CodelyTv\Mooc\Video\Domain\VideosFinder as DomainVideosFinder;

final class VideosFinder
{
    private $finder;

    public function __construct(VideoRepository $repository)
    {
        $this->finder = new DomainVideosFinder($repository);
    }

    public function __invoke()
    {
        return $this->finder->__invoke();
    }
}
