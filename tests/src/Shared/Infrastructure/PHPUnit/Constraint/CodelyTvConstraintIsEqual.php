<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\PHPUnit\Constraint;

use CodelyTv\Test\Shared\Infrastructure\PHPUnit\Comparator\StringableObjectSimilarComparator;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\IsEqual;
use SebastianBergmann\Comparator\Factory as ComparatorFactory;

final class CodelyTvConstraintIsEqual extends Constraint
{
    private $phpUnitIsEquals;

    private $stringableObjectSimilarComparator;

    public function __construct(
        $value,
        float $delta = 0.0,
        int $maxDepth = 10,
        bool $canonicalize = false,
        bool $ignoreCase = false
    ) {
        $this->phpUnitIsEquals = new IsEqual($value, $delta, $maxDepth, $canonicalize, $ignoreCase);

        $this->stringableObjectSimilarComparator = new StringableObjectSimilarComparator();
    }

    public function evaluate($other, string $description = '', bool $returnResult = false): bool
    {
        $comparatorFactory = ComparatorFactory::getInstance();
        $comparatorFactory->register($this->stringableObjectSimilarComparator);

        $result = $this->phpUnitIsEquals->evaluate($other, $description, $returnResult);

        $comparatorFactory->unregister($this->stringableObjectSimilarComparator);

        return $result;
    }

    public function toString(): string
    {
        return $this->phpUnitIsEquals->toString();
    }
}
