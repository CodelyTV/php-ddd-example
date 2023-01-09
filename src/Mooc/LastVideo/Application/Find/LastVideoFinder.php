<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Application\Find;

use CodelyTv\Mooc\LastVideo\Domain\LastVideoFinder as DomainLastVideoFinder;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoRepository;

final class LastVideoFinder
{
    private readonly DomainLastVideoFinder $finder;

    public function __construct(LastVideoRepository $repository)
    {
        $this->finder = new DomainLastVideoFinder($repository);
    }

    public function __invoke()
    {
        return $this->finder->__invoke();
    }
}
