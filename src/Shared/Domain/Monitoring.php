<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain;

interface Monitoring
{
	public function incrementCounter(int $times): void;

	public function incrementGauge(int $times): void;

	public function decrementGauge(int $times): void;

	public function setGauge(int $value): void;

	public function observeHistogram(int $value, array $labels = []): void;
}
