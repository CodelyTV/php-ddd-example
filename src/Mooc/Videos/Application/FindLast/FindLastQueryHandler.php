<?php

declare (strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\FindLast;

use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Shared\Domain\Criteria\Filters;
use CodelyTv\Shared\Domain\Criteria\Order;
use CodelyTv\Shared\Domain\Criteria\OrderBy;
use CodelyTv\Shared\Domain\Criteria\OrderType;

final class FindLastQueryHandler implements QueryHandler
{

    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function __invoke(FindLastQuery $query): ?Video
    {
        $order = new Order(new OrderBy('created'), OrderType::desc());
        $criteria = new Criteria(filters: new Filters([]), order: $order, offset: null, limit: 1);

        return $this->videoRepository->searchByCriteria($criteria)->first();
    }
}