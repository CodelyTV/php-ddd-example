<?php

declare(strict_types = 1);

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

    public static function createDesc(OrderBy $orderBy): Order
    {
        return new self($orderBy, OrderType::desc());
    }

    public function orderBy(): OrderBy
    {
        return $this->orderBy;
    }

    public function orderType(): OrderType
    {
        return $this->orderType;
    }
}
