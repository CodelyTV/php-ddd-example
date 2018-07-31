<?php

namespace CodelyTv\Shared\Domain\Criteria;

final class Order
{
    private $orderBy;
    private $orderType;

    public function __construct(OrderBy $orderBy, OrderType $orderType)
    {
        $this->orderBy   = $orderBy;
        $this->orderType = $orderType ?: OrderType::asc();
    }
}
