<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoFinder as DomainVideoFinder;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

final class VideoFinder
{
	private readonly DomainVideoFinder $finder;

	public function __construct(VideoRepository $repository)
	{
		$this->finder = new DomainVideoFinder($repository);
	}

	public function __invoke(VideoId $id): Video
	{
		return $this->finder->__invoke($id);
	}
}
