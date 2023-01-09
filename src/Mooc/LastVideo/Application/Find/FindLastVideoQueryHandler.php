<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\pipe;

final class FindLastVideoQueryHandler implements QueryHandler
{
    private $finder;

    public function __construct(LastVideoFinder $finder)
    {
        $this->finder = pipe($finder, new LastVideoResponseConverter());
    }

    public function __invoke(FindLastVideoQuery $query): LastVideoResponse
    {
        return apply($this->finder, []);
    }
}
