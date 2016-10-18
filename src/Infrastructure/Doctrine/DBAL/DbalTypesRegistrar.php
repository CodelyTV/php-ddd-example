<?php

namespace CodelyTv\Infrastructure\Doctrine\DBAL;

use Doctrine\DBAL\Types\Type;
use function Lambdish\Phunctional\each;

final class DbalTypesRegistrar
{
    private static $initialized = false;
    private static $types       = [
        DateTimeImmutableType::NAME => DateTimeImmutableType::class,
    ];

    public static function register()
    {
        if (!self::$initialized) {
            each(self::registerType(), self::$types);

            self::$initialized = true;
        }
    }

    private static function registerType()
    {
        return function ($class, $name) {
            Type::addType($name, $class);
        };
    }
}
