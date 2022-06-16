<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Application\SearchByCriteria;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final class SearchBackofficeCoursesByCriteriaQuery implements Query
{
    public function __construct(
        private readonly array $filters,
        private readonly ?string $orderBy,
        private readonly ?string $order,
        private readonly ?int $limit,
        private readonly ?int $offset
    ) {
    }

    public function filters(): array
    {
        return $this->filters;
    }

    public function orderBy(): ?string
    {
        return $this->orderBy;
    }

    public function order(): ?string
    {
        return $this->order;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }
}
