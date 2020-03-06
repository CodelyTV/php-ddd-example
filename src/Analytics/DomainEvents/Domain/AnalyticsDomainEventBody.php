<?php

declare(strict_types = 1);

namespace CodelyTv\Analytics\DomainEvents\Domain;

final class AnalyticsDomainEventBody
{
    private array $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    public function value(): array
    {
        return $this->value;
    }
}
