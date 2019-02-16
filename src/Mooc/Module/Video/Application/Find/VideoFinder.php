<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Module\Video\Application\Find;

use CodelyTv\Mooc\Module\Video\Domain\VideoId;
use CodelyTv\Mooc\Module\Video\Domain\VideoRepository;
use CodelyTv\Mooc\Module\Video\Domain\VideoFinder as DomainVideoFinder;

final class VideoFinder
{
    private $finder;

    public function __construct(VideoRepository $repository)
    {
        $this->finder = new DomainVideoFinder($repository);
    }

    public function __invoke(VideoId $id)
    {
        return $this->finder->__invoke($id);
    }
}
