<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Courses\Application\SearchAll;

use CodelyTv\Backoffice\Courses\Application\BackofficeCoursesResponse;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllBackofficeCoursesQueryHandler implements QueryHandler
{
    private $searcher;

    public function __construct(AllBackofficeCoursesSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(SearchAllBackofficeCoursesQuery $query): BackofficeCoursesResponse
    {
        return $this->searcher->searchAll();
    }
}
