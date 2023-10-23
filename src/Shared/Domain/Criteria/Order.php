<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\Criteria;

final readonly class Order
{
	public function __construct(private OrderBy $orderBy, private OrderType $orderType) {}

	public static function createDesc(OrderBy $orderBy): self
	{
		return new self($orderBy, OrderType::DESC);
	}

	public static function fromValues(?string $orderBy, ?string $order): self
	{
		return ($orderBy === null || $order === null) ? self::none() : new self(
			new OrderBy($orderBy),
			OrderType::from($order)
		);
	}

	public static function none(): self
	{
		return new self(new OrderBy(''), OrderType::NONE);
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
		return sprintf('%s.%s', $this->orderBy->value(), $this->orderType->value);
	}
}
