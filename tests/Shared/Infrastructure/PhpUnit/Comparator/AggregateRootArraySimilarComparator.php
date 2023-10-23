<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Infrastructure\PhpUnit\Comparator;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use CodelyTv\Tests\Shared\Domain\TestUtils;
use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Comparator\ComparisonFailure;

use function Lambdish\Phunctional\all;
use function Lambdish\Phunctional\any;
use function Lambdish\Phunctional\instance_of;

final class AggregateRootArraySimilarComparator extends Comparator
{
	public function accepts($expected, $actual): bool
	{
		return is_array($expected)
			   && is_array($actual)
			   && (all(instance_of(AggregateRoot::class), $expected)
				   && all(instance_of(AggregateRoot::class), $actual));
	}

	public function assertEquals($expected, $actual, $delta = 0.0, $canonicalize = false, $ignoreCase = false): void
	{
		if (!$this->contains($expected, $actual) || count($expected) !== count($actual)) {
			throw new ComparisonFailure(
				$expected,
				$actual,
				$this->exporter->export($expected),
				$this->exporter->export($actual),
				false,
				'Failed asserting the collection of AGs contains all the expected elements.'
			);
		}
	}

	private function contains(array $expectedArray, array $actualArray): bool
	{
		$exists = fn (AggregateRoot $expected): bool => any(
			fn (AggregateRoot $actual): bool => TestUtils::isSimilar($expected, $actual),
			$actualArray
		);

		return all($exists, $expectedArray);
	}
}
