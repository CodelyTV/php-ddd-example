<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\CoursesCounter\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

final readonly class FindCoursesCounterQueryHandler implements QueryHandler
{
	public function __construct(private CoursesCounterFinder $finder) {}

	public function __invoke(FindCoursesCounterQuery $query): CoursesCounterResponse
	{
		return $this->finder->__invoke();
	}
}
