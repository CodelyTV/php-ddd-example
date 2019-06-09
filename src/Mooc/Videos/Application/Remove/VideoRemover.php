<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Remove;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoNotFound;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

final class VideoRemover
{
	private $repository;

	public function __construct(VideoRepository $repository)
	{
		$this->repository = $repository;
	}

	public function remove(VideoId $id): void
	{
		$video = $this->repository->search($id);

		if (null !== $video) {
			$this->repository->remove($video);
		} else {
			throw new VideoNotFound($id);
		}


	}

}