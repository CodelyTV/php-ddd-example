<?php

namespace CodelyTv\Test\Infrastructure\PHPUnit\Constraint;

use CodelyTv\Test\Infrastructure\PHPUnit\Comparator\AggregateRootArraySimilarComparator;
use CodelyTv\Test\Infrastructure\PHPUnit\Comparator\AggregateRootSimilarComparator;
use CodelyTv\Test\Infrastructure\PHPUnit\Comparator\DateTimeSimilarComparator;
use CodelyTv\Test\Infrastructure\PHPUnit\Comparator\DateTimeStringSimilarComparator;
use CodelyTv\Test\Infrastructure\PHPUnit\Comparator\DomainEventArraySimilarComparator;
use CodelyTv\Test\Infrastructure\PHPUnit\Comparator\DomainEventSimilarComparator;
use CodelyTv\Test\Infrastructure\PHPUnit\Comparator\StringableObjectSimilarComparator;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\ExpectationFailedException;
use SebastianBergmann\Comparator\ComparisonFailure;
use SebastianBergmann\Comparator\Factory;

class CodelyTvConstraintIsSimilar extends IsEqual
{
    public function evaluate($other, $description = '', $returnResult = false)
    {
        $isValid           = true;
        $comparatorFactory = new Factory();

        $comparatorFactory->register(new AggregateRootArraySimilarComparator());
        $comparatorFactory->register(new AggregateRootSimilarComparator());
        $comparatorFactory->register(new DomainEventArraySimilarComparator());
        $comparatorFactory->register(new DomainEventSimilarComparator());
        $comparatorFactory->register(new DateTimeSimilarComparator());
        $comparatorFactory->register(new DateTimeStringSimilarComparator());
        $comparatorFactory->register(new StringableObjectSimilarComparator());

        try {
            $comparator = $comparatorFactory->getComparatorFor($other, $this->value);

            $comparator->assertEquals($this->value, $other, $this->delta, $this->canonicalize, $this->ignoreCase);
        } catch (ComparisonFailure $f) {
            if (!$returnResult) {
                throw new ExpectationFailedException(
                    trim($description . "\n" . $f->getMessage()),
                    $f
                );
            }

            $isValid = false;
        }

        return $isValid;
    }
}
