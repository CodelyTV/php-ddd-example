<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Shared\Domain\Criteria\Filters;
use CodelyTv\Shared\Domain\Criteria\Order;
use CodelyTv\Test\Shared\Domain\NumberMother;

final class CriteriaMother
{
    public static function create(Filters $filters, ?Order $order, ?int $offset, ?int $limit): Criteria
    {
        return new Criteria($filters, $order, $offset, $limit);
    }

    public static function noFilters(): Criteria
    {
        return self::create(FiltersMother::blank(), null, null, null);
    }

    public static function random(): Criteria
    {
        return self::create(
            FiltersMother::random(),
            OrderMother::random(),
            NumberMother::random(),
            NumberMother::random()
        );
    }
}
