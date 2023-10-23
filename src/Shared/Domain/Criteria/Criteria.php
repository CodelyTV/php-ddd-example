<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\Criteria;

final readonly class Criteria
{
	public function __construct(
		private Filters $filters,
		private Order $order,
		private ?int $offset,
		private ?int $limit
	) {}

	public function hasFilters(): bool
	{
		return $this->filters->count() > 0;
	}

	public function hasOrder(): bool
	{
		return !$this->order->isNone();
	}

	public function plainFilters(): array
	{
		return $this->filters->filters();
	}

	public function filters(): Filters
	{
		return $this->filters;
	}

	public function order(): Order
	{
		return $this->order;
	}

	public function offset(): ?int
	{
		return $this->offset;
	}

	public function limit(): ?int
	{
		return $this->limit;
	}

	public function serialize(): string
	{
		return sprintf(
			'%s~~%s~~%s~~%s',
			$this->filters->serialize(),
			$this->order->serialize(),
			$this->offset ?? 'none',
			$this->limit ?? 'none'
		);
	}
}
