<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\PHPUnit\Constraint;

use CodelyTv\Test\Shared\Infrastructure\PHPUnit\Comparator\AggregateRootArraySimilarComparator;
use CodelyTv\Test\Shared\Infrastructure\PHPUnit\Comparator\AggregateRootSimilarComparator;
use CodelyTv\Test\Shared\Infrastructure\PHPUnit\Comparator\DateTimeSimilarComparator;
use CodelyTv\Test\Shared\Infrastructure\PHPUnit\Comparator\DateTimeStringSimilarComparator;
use CodelyTv\Test\Shared\Infrastructure\PHPUnit\Comparator\DomainEventArraySimilarComparator;
use CodelyTv\Test\Shared\Infrastructure\PHPUnit\Comparator\DomainEventSimilarComparator;
use CodelyTv\Test\Shared\Infrastructure\PHPUnit\Comparator\StringableObjectSimilarComparator;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\IsEqual;
use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Comparator\Factory;
use SebastianBergmann\Comparator\Factory as ComparatorFactory;
use function Lambdish\Phunctional\each;

final class CodelyTvConstraintIsSimilar extends Constraint
{
    private $phpUnitIsEquals;

    private $comparators;

    public function __construct(
        $value,
        float $delta = 0.0,
        int $maxDepth = 10,
        bool $canonicalize = false,
        bool $ignoreCase = false
    ) {
        $this->phpUnitIsEquals = new IsEqual($value, $delta, $maxDepth, $canonicalize, $ignoreCase);

        $this->comparators = [
            new AggregateRootArraySimilarComparator(),
            new AggregateRootSimilarComparator(),
            new DomainEventArraySimilarComparator(),
            new DomainEventSimilarComparator(),
            new DateTimeSimilarComparator(),
            new DateTimeStringSimilarComparator(),
            new StringableObjectSimilarComparator()
        ];
    }

    public function evaluate($other, string $description = '', bool $returnResult = false): bool
    {
        $comparatorFactory = ComparatorFactory::getInstance();

        each($this->comparatorRegistrar($comparatorFactory), $this->comparators);

        $result = $this->phpUnitIsEquals->evaluate($other, $description, $returnResult);

        each($this->comparatorUnregistrar($comparatorFactory), $this->comparators);

        return $result;
    }

    private function comparatorRegistrar(Factory $comparatorFactory): callable
    {
        return function (Comparator $comparator) use ($comparatorFactory): void {
            $comparatorFactory->register($comparator);
        };
    }

    private function comparatorUnregistrar(Factory $comparatorFactory): callable
    {
        return function (Comparator $comparator) use ($comparatorFactory): void {
            $comparatorFactory->unregister($comparator);
        };
    }

    public function toString(): string
    {
        return $this->phpUnitIsEquals->toString();
    }
}
