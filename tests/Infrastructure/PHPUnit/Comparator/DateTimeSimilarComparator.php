<?php

declare(strict_types=1);

namespace CodelyTv\Test\Infrastructure\PHPUnit\Comparator;

use DateInterval;
use DateTime;
use DateTimeInterface;
use SebastianBergmann\Comparator\ComparisonFailure;
use SebastianBergmann\Comparator\ObjectComparator;

class DateTimeSimilarComparator extends ObjectComparator
{
    public function accepts($expected, $actual)
    {
        return $expected instanceof DateTimeInterface && $actual instanceof DateTimeInterface;
    }

    public function assertEquals(
        $expected,
        $actual,
        $delta = 0.0,
        $canonicalize = false,
        $ignoreCase = false,
        array &$processed = array()
    ) {
        $delta = $delta === 0.0 ? 10 : $delta;
        $delta = new DateInterval(sprintf('PT%sS', abs($delta)));

        $expectedLower = clone $expected;
        $expectedUpper = clone $expected;

        if ($actual < $expectedLower->sub($delta) || $actual > $expectedUpper->add($delta)) {
            throw new ComparisonFailure(
                $expected,
                $actual,
                $this->dateTimeToString($expected),
                $this->dateTimeToString($actual),
                false,
                'Failed asserting that two DateTime objects are equal.'
            );
        }
    }

    protected function dateTimeToString(DateTimeInterface $datetime)
    {
        $string = $datetime->format(DateTime::ISO8601);

        return $string ? $string : 'Invalid DateTime object';
    }
}
