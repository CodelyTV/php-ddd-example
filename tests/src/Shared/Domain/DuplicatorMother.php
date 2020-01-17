<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Shared\Domain;

use ReflectionObject;
use ReflectionProperty;
use function Lambdish\Phunctional\each;

final class DuplicatorMother
{
    public static function with($object, array $newParams)
    {
        $duplicated = clone $object;
        $reflection = new ReflectionObject($duplicated);

        each(
            static function (ReflectionProperty $property) use ($duplicated, $newParams) {
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
