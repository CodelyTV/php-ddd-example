<?php

declare(strict_types=1);

namespace CodelyTv\Analytics\DomainEvents\Domain;

final readonly class AnalyticsDomainEventBody
{
	public function __construct(private array $value) {}

	public function value(): array
	{
		return $this->value;
	}
}
