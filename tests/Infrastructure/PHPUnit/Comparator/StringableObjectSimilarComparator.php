<?php

namespace CodelyTv\Test\Infrastructure\PHPUnit\Comparator;

use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Comparator\ComparisonFailure;

class StringableObjectSimilarComparator extends Comparator
{
    public function accepts($expected, $actual)
    {
        return ($this->isStringable($expected) && !is_object($actual)) ||
               ($this->isStringable($actual) && !is_object($expected));
    }

    public function assertEquals($expected, $actual, $delta = 0.0, $canonicalize = false, $ignoreCase = false)
    {
        if (gettype($expected) !== gettype($actual)) {
            throw new ComparisonFailure(
                $expected,
                $actual,
                $this->exporter->export($expected),
                $this->exporter->export($actual),
                false,
                'Failed asserting that stringable objects are similar.'
            );
        }
    }

    private function isStringable($possibleStringable)
    {
        return is_object($possibleStringable) && method_exists($possibleStringable, '__toString');
    }
}
