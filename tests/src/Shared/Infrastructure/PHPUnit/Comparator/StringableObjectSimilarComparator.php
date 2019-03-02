<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\PHPUnit\Comparator;

use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Comparator\ComparisonFailure;

final class StringableObjectSimilarComparator extends Comparator
{
    public function accepts($expected, $actual): bool
    {
        return ($this->isStringable($expected) && !is_object($actual)) ||
               ($this->isStringable($actual) && !is_object($expected));
    }

    public function assertEquals($expected, $actual, $delta = 0.0, $canonicalize = false, $ignoreCase = false): void
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

    private function isStringable($possibleStringable): bool
    {
        return is_object($possibleStringable) && method_exists($possibleStringable, '__toString');
    }
}
