<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Video\Application\Find;

use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Mooc\Video\Domain\VideosFinder;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\pipe;

final class FindAllVideosQueryHandler implements QueryHandler
{
    private $finder;

    public function __construct(\CodelyTv\Mooc\Video\Application\Find\VideosFinder $finder)
    {
        $this->finder = pipe($finder, new VideosResponseConverter());
    }

    public function __invoke(FindAllVideosQuery $query): VideosResponse
    {
        return apply($this->finder, []);
    }
}
