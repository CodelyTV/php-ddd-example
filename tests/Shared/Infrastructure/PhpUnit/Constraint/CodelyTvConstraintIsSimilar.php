<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Infrastructure\PhpUnit\Constraint;

use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\Comparator\AggregateRootArraySimilarComparator;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\Comparator\AggregateRootSimilarComparator;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\Comparator\DateTimeSimilarComparator;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\Comparator\DateTimeStringSimilarComparator;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\Comparator\DomainEventArraySimilarComparator;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\Comparator\DomainEventSimilarComparator;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\ExpectationFailedException;
use SebastianBergmann\Comparator\ComparisonFailure;
use SebastianBergmann\Comparator\Factory;

use function is_string;
use function sprintf;

// Based on \PHPUnit\Framework\Constraint\IsEqual
final class CodelyTvConstraintIsSimilar extends Constraint
{
	public function __construct(private $value, private readonly float $delta = 0.0) {}

	public function evaluate($other, $description = '', $returnResult = false): bool
	{
		if ($this->value === $other) {
			return true;
		}

		$isValid = true;
		$comparatorFactory = new Factory();

		$comparatorFactory->register(new AggregateRootArraySimilarComparator());
		$comparatorFactory->register(new AggregateRootSimilarComparator());
		$comparatorFactory->register(new DomainEventArraySimilarComparator());
		$comparatorFactory->register(new DomainEventSimilarComparator());
		$comparatorFactory->register(new DateTimeSimilarComparator());
		$comparatorFactory->register(new DateTimeStringSimilarComparator());

		try {
			$comparator = $comparatorFactory->getComparatorFor($other, $this->value);

			$comparator->assertEquals($this->value, $other, $this->delta);
		} catch (ComparisonFailure $f) {
			if (!$returnResult) {
				throw new ExpectationFailedException(trim($description . "\n" . $f->getMessage()), $f);
			}

			$isValid = false;
		}

		return $isValid;
	}

	public function toString(): string
	{
		$delta = '';

		if (is_string($this->value)) {
			if (str_contains($this->value, "\n")) {
				return 'is equal to <text>';
			}

			return sprintf("is equal to '%s'", $this->value);
		}

		if ($this->delta !== 0) {
			$delta = sprintf(' with delta <%F>', $this->delta);
		}

		return sprintf('is equal to %s%s', $this->exporter()->export($this->value), $delta);
	}
}
