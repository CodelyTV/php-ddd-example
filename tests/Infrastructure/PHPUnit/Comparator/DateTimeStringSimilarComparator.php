<?php

declare(strict_types=1);

namespace CodelyTv\Test\Infrastructure\PHPUnit\Comparator;

use DateInterval;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use SebastianBergmann\Comparator\ComparisonFailure;
use SebastianBergmann\Comparator\ObjectComparator;
use Throwable;

class DateTimeStringSimilarComparator extends ObjectComparator
{
    public function accepts($expected, $actual)
    {
        return (null !== $actual) &&
            is_string($expected) &&
            is_string($actual) &&
            $this->isValidDateTimeString($expected) &&
            $this->isValidDateTimeString($actual);
    }

    private function isValidDateTimeString($expected)
    {
        $isValid = true;

        try {
            new DateTimeImmutable($expected);
        } catch (Throwable $throwable) {
            $isValid = false;
        }

        return $isValid;
    }

    public function assertEquals(
        $expected,
        $actual,
        $delta = 0.0,
        $canonicalize = false,
        $ignoreCase = false,
        array &$processed = array()
    ) {
        $expectedDate = new DateTimeImmutable($expected);
        $actualDate   = new DateTimeImmutable($actual);

        $delta = $delta === 0.0 ? 10 : $delta;
        $delta = new DateInterval(sprintf('PT%sS', abs($delta)));

        if ($actualDate < $expectedDate->sub($delta) || $actualDate > $expectedDate->add($delta)) {
            throw new ComparisonFailure(
                $expectedDate,
                $actualDate,
                $this->dateTimeToString($expectedDate),
                $this->dateTimeToString($actualDate),
                false,
                'Failed asserting that two DateTime strings are equal.'
            );
        }
    }

    protected function dateTimeToString(DateTimeInterface $datetime)
    {
        $string = $datetime->format(DateTime::ISO8601);

        return $string ?: 'Invalid DateTime object';
    }
}
