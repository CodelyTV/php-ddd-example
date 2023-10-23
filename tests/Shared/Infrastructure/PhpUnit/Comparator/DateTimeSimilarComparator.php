<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Infrastructure\PhpUnit\Comparator;

use DateInterval;
use DateTime;
use DateTimeInterface;
use SebastianBergmann\Comparator\ComparisonFailure;
use SebastianBergmann\Comparator\ObjectComparator;

final class DateTimeSimilarComparator extends ObjectComparator
{
	public function accepts($expected, $actual): bool
	{
		return $expected instanceof DateTimeInterface && $actual instanceof DateTimeInterface;
	}

	public function assertEquals(
		$expected,
		$actual,
		$delta = 0.0,
		$canonicalize = false,
		$ignoreCase = false,
		array &$processed = []
	): void {
		$normalizedDelta = $delta === 0.0 ? 10 : $delta;
		$intervalWithDelta = new DateInterval(sprintf('PT%sS', abs($normalizedDelta)));

		$expectedLower = clone $expected;
		$expectedUpper = clone $expected;

		if ($actual < $expectedLower->sub($intervalWithDelta) || $actual > $expectedUpper->add($intervalWithDelta)) {
			throw new ComparisonFailure(
				$expected,
				$actual,
				$this->dateTimeToString($expected),
				$this->dateTimeToString($actual),
				false,
				'Failed asserting that two DateTime objects are equal.'
			);
		}
	}

	protected function dateTimeToString(DateTimeInterface $datetime): string
	{
		return $datetime->format(DateTime::ATOM) ?: 'Invalid DateTime object';
	}
}
