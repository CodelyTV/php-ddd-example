<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Application\Find;

use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoResponse;
use CodelyTv\Context\Video\Module\Video\Domain\VideoResponseConverter;
use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\pipe;

final class FindVideoQueryHandler
{
    private $finder;

    public function __construct(VideoFinder $finder)
    {
        $this->finder = pipe($finder, new VideoResponseConverter());
    }

    public function __invoke(FindVideoQuery $query): VideoResponse
    {
        $id = new VideoId($query->id());

        return apply($this->finder, [$id]);
    }
}
