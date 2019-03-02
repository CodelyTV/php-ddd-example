<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\PHPUnit\Comparator;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Comparator\ComparisonFailure;
use function CodelyTv\Test\Shared\isSimilar;
use function Lambdish\Phunctional\all;
use function Lambdish\Phunctional\any;
use function Lambdish\Phunctional\instance_of;

final class DomainEventArraySimilarComparator extends Comparator
{
    public function accepts($expected, $actual): bool
    {
        return is_array($expected) &&
               is_array($actual) &&
               (all(instance_of(DomainEvent::class), $expected) &&
                all(instance_of(DomainEvent::class), $actual));
    }

    public function assertEquals($expected, $actual, $delta = 0.0, $canonicalize = false, $ignoreCase = false): void
    {
        if (!$this->contains($expected, $actual) || count($expected) !== count($actual)) {
            throw new ComparisonFailure(
                $expected,
                $actual,
                $this->exporter->export($expected),
                $this->exporter->export($actual),
                false,
                'Failed asserting the collection of Events contains all the expected elements.'
            );
        }
    }

    private function contains(array $expectedArray, array $actualArray): bool
    {
        $exists = function (DomainEvent $expected) use ($actualArray) {
            return any(
                function (DomainEvent $actual) use ($expected) {
                    return isSimilar($expected, $actual);
                },
                $actualArray
            );
        };

        return all($exists, $expectedArray);
    }
}
