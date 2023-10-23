<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Infrastructure\PhpUnit\Comparator;

use DateInterval;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use SebastianBergmann\Comparator\ComparisonFailure;
use SebastianBergmann\Comparator\ObjectComparator;
use Throwable;

final class DateTimeStringSimilarComparator extends ObjectComparator
{
	public function accepts($expected, $actual): bool
	{
		return is_string($expected)
			   && is_string($actual)
			   && $this->isValidDateTimeString($expected)
			   && $this->isValidDateTimeString($actual);
	}

	public function assertEquals(
		$expected,
		$actual,
		$delta = 0.0,
		$canonicalize = false,
		$ignoreCase = false,
		array &$processed = []
	): void {
		$expectedDate = new DateTimeImmutable($expected);
		$actualDate = new DateTimeImmutable($actual);

		$normalizedDelta = $delta === 0.0 ? 10 : $delta;
		$intervalWithDelta = new DateInterval(sprintf('PT%sS', abs($normalizedDelta)));

		if ($actualDate < $expectedDate->sub($intervalWithDelta)
			|| $actualDate > $expectedDate->add($intervalWithDelta)) {
			throw new ComparisonFailure(
				$expectedDate,
				$actualDate,
				$this->dateTimeToString($expectedDate),
				$this->dateTimeToString($actualDate),
				false,
				'Failed asserting that two DateTime strings are equal.'
			);
		}
	}

	protected function dateTimeToString(DateTimeInterface $datetime): string
	{
		$string = $datetime->format(DateTime::ATOM);

		return $string ?: 'Invalid DateTime object';
	}

	private function isValidDateTimeString(string $expected): bool
	{
		$isValid = true;

		try {
			new DateTimeImmutable($expected);
		} catch (Throwable) {
			$isValid = false;
		}

		return $isValid;
	}
}
