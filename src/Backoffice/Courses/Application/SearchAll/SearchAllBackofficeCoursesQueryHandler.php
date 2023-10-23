<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Application\SearchAll;

use CodelyTv\Backoffice\Courses\Application\BackofficeCoursesResponse;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

final readonly class SearchAllBackofficeCoursesQueryHandler implements QueryHandler
{
	public function __construct(private AllBackofficeCoursesSearcher $searcher) {}

	public function __invoke(SearchAllBackofficeCoursesQuery $query): BackofficeCoursesResponse
	{
		return $this->searcher->searchAll();
	}
}
