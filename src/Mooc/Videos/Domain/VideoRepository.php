<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\Criteria\Criteria;

interface VideoRepository
{
	public function save(Video $video): void;

	public function search(VideoId $id): ?Video;

	public function searchByCriteria(Criteria $criteria): Videos;
}
