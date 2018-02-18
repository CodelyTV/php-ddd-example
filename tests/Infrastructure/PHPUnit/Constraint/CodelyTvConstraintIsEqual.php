<?php

namespace CodelyTv\Test\Infrastructure\PHPUnit\Constraint;

use CodelyTv\Test\Infrastructure\PHPUnit\Comparator\StringableObjectSimilarComparator;
use PHPUnit_Framework_Constraint_IsEqual;
use PHPUnit_Framework_ExpectationFailedException;
use SebastianBergmann\Comparator\ComparisonFailure;
use SebastianBergmann\Comparator\Factory;

class CodelyTvConstraintIsEqual extends PHPUnit_Framework_Constraint_IsEqual
{
    public function evaluate($other, $description = '', $returnResult = false)
    {
        $isValid           = true;
        $comparatorFactory = new Factory();

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
