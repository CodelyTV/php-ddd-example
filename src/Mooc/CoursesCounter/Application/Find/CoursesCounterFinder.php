<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\CoursesCounter\Application\Find;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterNotExist;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterRepository;

final readonly class CoursesCounterFinder
{
	public function __construct(private CoursesCounterRepository $repository) {}

	public function __invoke(): CoursesCounterResponse
	{
		$counter = $this->repository->search();

		if ($counter === null) {
			throw new CoursesCounterNotExist();
		}

		return new CoursesCounterResponse($counter->total()->value());
	}
}
