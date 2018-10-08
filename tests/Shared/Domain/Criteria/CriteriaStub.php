<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Shared\Domain\Criteria\Filters;
use CodelyTv\Shared\Domain\Criteria\Order;
use CodelyTv\Test\Shared\Domain\NumberStub;

final class CriteriaStub
{
    public static function create(Filters $filters, ?Order $order, ?int $offset, ?int $limit)
    {
        return new Criteria($filters, $order, $offset, $limit);
    }

    public static function noFilters()
    {
        return self::create(FiltersStub::blank(), null, null, null);
    }

    public static function random()
    {
        return self::create(FiltersStub::random(), OrderStub::random(), NumberStub::random(), NumberStub::random());
    }
}
