<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\Criteria;

final class Order
{
    public function __construct(private OrderBy $orderBy, private OrderType $orderType)
    {
    }

    public static function createDesc(OrderBy $orderBy): Order
    {
        return new self($orderBy, OrderType::desc());
    }

    public static function fromValues(?string $orderBy, ?string $order): Order
    {
        return null === $orderBy ? self::none() : new Order(new OrderBy($orderBy), new OrderType($order));
    }

    public static function none(): Order
    {
        return new Order(new OrderBy(''), OrderType::none());
    }

    public function orderBy(): OrderBy
    {
        return $this->orderBy;
    }

    public function orderType(): OrderType
    {
        return $this->orderType;
    }

    public function isNone(): bool
    {
        return $this->orderType()->isNone();
    }

    public function serialize(): string
    {
        return sprintf('%s.%s', $this->orderBy->value(), $this->orderType->value());
    }
}
