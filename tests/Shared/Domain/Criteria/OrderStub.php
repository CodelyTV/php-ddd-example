<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\Criteria\Order;
use CodelyTv\Shared\Domain\Criteria\OrderBy;
use CodelyTv\Shared\Domain\Criteria\OrderType;

final class OrderStub
{
    public static function create(OrderBy $orderBy, OrderType $orderType)
    {
        return new Order($orderBy, $orderType);
    }

    public static function createDesc($orderBy)
    {
        return Order::createDesc($orderBy);
    }

    public static function random()
    {
        return self::create(OrderByStub::random(), OrderType::random());
    }
}
