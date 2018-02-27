<?php

namespace CodelyTv\Test\Shared\Domain;

use ReflectionObject;
use ReflectionProperty;
use function Lambdish\Phunctional\each;

final class DuplicatorStub
{
    public static function with($object, array $newParams)
    {
        $duplicated = clone $object;
        $reflection = new ReflectionObject($duplicated);

        each(
            function (ReflectionProperty $property) use ($duplicated, $newParams) {
                if (isset($newParams[$property->getName()])) {
                    $property->setAccessible(true);
                    $property->setValue($duplicated, $newParams[$property->getName()]);
                }
            },
            $reflection->getProperties()
        );

        return $duplicated;
    }
}
