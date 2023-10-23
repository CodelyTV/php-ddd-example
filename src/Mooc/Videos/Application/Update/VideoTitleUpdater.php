<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Videos\Domain\VideoFinder;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;

final readonly class VideoTitleUpdater
{
	private VideoFinder $finder;

	public function __construct(private VideoRepository $repository)
	{
		$this->finder = new VideoFinder($repository);
	}

	public function __invoke(VideoId $id, VideoTitle $newTitle): void
	{
		$video = $this->finder->__invoke($id);

		$video->updateTitle($newTitle);

		$this->repository->save($video);
	}
}
