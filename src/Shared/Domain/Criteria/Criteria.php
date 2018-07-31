<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain\Criteria;

final class Criteria
{
    private $filters;
    private $order;
    private $offset;
    private $limit;

    public function __construct(Filters $filters, ?Order $order, int $offset, int $limit)
    {
        $this->filters = $filters;
        $this->order   = $order;
        $this->offset  = $offset;
        $this->limit   = $limit;
    }

    public function hasFilters(): bool
    {
        return $this->filters->count() > 0;
    }

    public function hasOrder(): bool
    {
        return null !== $this->order;
    }

    public function plainFilters(): array
    {
        return $this->filters->filters();
    }
}
