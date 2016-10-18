<?php

namespace CodelyTv\Test\PhpUnit\Constraint;

use CodelyTv\Test\PhpUnit\Comparator\AggregateRootArraySimilarComparator;
use CodelyTv\Test\PhpUnit\Comparator\AggregateRootSimilarComparator;
use CodelyTv\Test\PhpUnit\Comparator\DateTimeSimilarComparator;
use CodelyTv\Test\PhpUnit\Comparator\DateTimeStringSimilarComparator;
use CodelyTv\Test\PhpUnit\Comparator\DomainEventArraySimilarComparator;
use CodelyTv\Test\PhpUnit\Comparator\DomainEventSimilarComparator;
use CodelyTv\Test\PhpUnit\Comparator\StringableObjectSimilarComparator;
use PHPUnit_Framework_Constraint_IsEqual;
use PHPUnit_Framework_ExpectationFailedException;
use SebastianBergmann\Comparator\ComparisonFailure;
use SebastianBergmann\Comparator\Factory;

class CodelyTvConstraintIsSimilar extends PHPUnit_Framework_Constraint_IsEqual
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
                throw new PHPUnit_Framework_ExpectationFailedException(
                    trim($description . "\n" . $f->getMessage()),
                    $f
                );
            }

            $isValid = false;
        }

        return $isValid;
    }
}
