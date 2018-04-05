<?php

namespace CodelyTv\Test\Infrastructure\PHPUnit\Comparator;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use ReflectionObject;
use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Comparator\ComparisonFailure;
use function CodelyTv\Test\isSimilar;

final class DomainEventSimilarComparator extends Comparator
{
    private static $ignoredAttributes = ['eventId', 'occurredOn'];

    public function accepts($expected, $actual)
    {
        $domainEventRootClass = DomainEvent::class;

        return $expected instanceof $domainEventRootClass && $actual instanceof $domainEventRootClass;
    }

    /**
     * @param DomainEvent                                   $expected
     * @param \CodelyTv\Shared\Domain\Bus\Event\DomainEvent $actual
     */
    public function assertEquals($expected, $actual, $delta = 0.0, $canonicalize = false, $ignoreCase = false)
    {
        if (!$this->areSimilar($expected, $actual)) {
            throw new ComparisonFailure(
                $expected,
                $actual,
                $this->exporter->export($expected),
                $this->exporter->export($actual),
                false,
                'Failed asserting the events are equal.'
            );
        }
    }

    /**
     * @param DomainEvent $expected
     * @param DomainEvent $actual
     */
    private function areSimilar($expected, $actual)
    {
        if (!$this->areTheSameClass($expected, $actual)) {
            return false;
        }

        return $this->propertiesAreSimilar($expected, $actual);
    }

    /**
     * @param DomainEvent $expected
     * @param DomainEvent $actual
     */
    private function areTheSameClass($expected, $actual)
    {
        return get_class($expected) === get_class($actual);
    }

    /**
     * @param DomainEvent $expected
     * @param DomainEvent $actual
     */
    private function propertiesAreSimilar($expected, $actual)
    {
        $expectedReflected = new ReflectionObject($expected);
        $actualReflected   = new ReflectionObject($actual);

        foreach ($expectedReflected->getProperties() as $expectedReflectedProperty) {
            if (!in_array($expectedReflectedProperty->getName(), self::$ignoredAttributes)) {
                $actualReflectedProperty = $actualReflected->getProperty($expectedReflectedProperty->getName());

                $expectedReflectedProperty->setAccessible(true);
                $actualReflectedProperty->setAccessible(true);

                $expectedProperty = $expectedReflectedProperty->getValue($expected);
                $actualProperty   = $actualReflectedProperty->getValue($actual);

                if (!isSimilar($expectedProperty, $actualProperty)) {
                    return false;
                }
            }
        }

        return true;
    }
}
