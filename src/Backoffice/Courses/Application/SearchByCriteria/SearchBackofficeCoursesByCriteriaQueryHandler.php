<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Courses\Application\SearchByCriteria;

use CodelyTv\Backoffice\Courses\Application\BackofficeCoursesResponse;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use CodelyTv\Shared\Domain\Criteria\Filters;
use CodelyTv\Shared\Domain\Criteria\Order;

final class SearchBackofficeCoursesByCriteriaQueryHandler implements QueryHandler
{
    private $searcher;

    public function __construct(BackofficeCoursesByCriteriaSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(SearchBackofficeCoursesByCriteriaQuery $query): BackofficeCoursesResponse
    {
        $filters = Filters::fromValues($query->filters());
        $order   = Order::fromValues($query->orderBy(), $query->order());

        return $this->searcher->search($filters, $order, $query->limit(), $query->offset());
    }
}
