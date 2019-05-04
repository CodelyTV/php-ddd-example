<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Find;


use CodelyTv\Mooc\Videos\Domain\LastVideoFinder as DomainLastVideoFinder;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

final class LastVideoFinder
{
    private $finder;

    public function __construct(VideoRepository $repository)
    {
        $this->finder = new DomainLastVideoFinder($repository);
    }

    public function __invoke()
    {
        return $this->finder->__invoke();
    }

}