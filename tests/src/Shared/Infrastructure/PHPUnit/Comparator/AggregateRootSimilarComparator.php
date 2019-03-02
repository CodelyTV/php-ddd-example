<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\PHPUnit\Comparator;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use ReflectionObject;
use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Comparator\ComparisonFailure;
use function CodelyTv\Test\Shared\isSimilar;

final class AggregateRootSimilarComparator extends Comparator
{
    public function accepts($expected, $actual): bool
    {
        $aggregateRootClass = AggregateRoot::class;

        return $expected instanceof $aggregateRootClass && $actual instanceof $aggregateRootClass;
    }

    /**
     * @param AggregateRoot $expected
     * @param AggregateRoot $actual
     */
    public function assertEquals($expected, $actual, $delta = 0.0, $canonicalize = false, $ignoreCase = false): void
    {
        $actualEntity = clone $actual;
        $actualEntity->pullDomainEvents();

        if (!$this->aggregateRootsAreSimilar($expected, $actualEntity)) {
            throw new ComparisonFailure(
                $expected,
                $actual,
                $this->exporter->export($expected),
                $this->exporter->export($actual),
                false,
                'Failed asserting the aggregate roots are equal.'
            );
        }
    }

    /**
     * @param AggregateRoot $expected
     * @param AggregateRoot $actual
     */
    private function aggregateRootsAreSimilar($expected, $actual): bool
    {
        if (!$this->aggregateRootsAreTheSameClass($expected, $actual)) {
            return false;
        }

        return $this->aggregateRootPropertiesAreSimilar($expected, $actual);
    }

    /**
     * @param AggregateRoot $expected
     * @param AggregateRoot $actual
     */
    private function aggregateRootsAreTheSameClass($expected, $actual): bool
    {
        return get_class($expected) === get_class($actual);
    }

    /**
     * @param AggregateRoot $expected
     * @param AggregateRoot $actual
     */
    private function aggregateRootPropertiesAreSimilar($expected, $actual): bool
    {
        $expectedReflected = new ReflectionObject($expected);
        $actualReflected   = new ReflectionObject($actual);

        foreach ($expectedReflected->getProperties() as $expectedReflectedProperty) {
            $actualReflectedProperty = $actualReflected->getProperty($expectedReflectedProperty->getName());

            $expectedReflectedProperty->setAccessible(true);
            $actualReflectedProperty->setAccessible(true);

            $expectedProperty = $expectedReflectedProperty->getValue($expected);
            $actualProperty   = $actualReflectedProperty->getValue($actual);

            if (!isSimilar($expectedProperty, $actualProperty)) {
                return false;
            }
        }

        return true;
    }
}
