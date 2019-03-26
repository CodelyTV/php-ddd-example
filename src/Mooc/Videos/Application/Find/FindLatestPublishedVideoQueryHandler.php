<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Mooc\Videos\Application\Find\FindLatestPublishedVideoQuery;
use CodelyTv\Mooc\Videos\Application\Find\VideoResponseConverter;
use CodelyTv\Mooc\Videos\Domain\NoVideos;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Shared\Domain\Criteria\Filters;
use CodelyTv\Shared\Domain\Criteria\Order;
use CodelyTv\Shared\Domain\Criteria\OrderBy;
use CodelyTv\Shared\Domain\Criteria\OrderType;

final class FindLatestPublishedVideoQueryHandler implements QueryHandler
{
    private $videoRepository;

    public function __construct(VideoRepository $repository)
    {
        $this->videoRepository = $repository;
    }

    public function __invoke(FindLatestPublishedVideoQuery $videoQuery) {
        $orderBy = new OrderBy("url");
        $orderType = new OrderType("desc");
        // todo continue here
        $order = new Order($orderBy, $orderType);
        $filters = Filters::fromValues(array());
        $criteria = new Criteria($filters, $order, null, null);

        try {
            $videos = $this->videoRepository->searchByCriteria($criteria);
        } catch (\Throwable $e) {
            throw new NoVideos();
        }

        if ($videos->count() == 0) {
            throw new NoVideos();
        }

        $converter = new VideoResponseConverter();
        return $converter($videos->getIterator()->current());
    }
}
