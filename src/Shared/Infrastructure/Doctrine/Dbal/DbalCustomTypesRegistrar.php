<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Doctrine\Dbal;

use Doctrine\DBAL\Types\Type;
use function Lambdish\Phunctional\each;

final class DbalCustomTypesRegistrar
{
    private static $initialized = false;

    public static function register(array $dbalCustomTypesClasses): void
    {
        if (!self::$initialized) {
            each(self::registerType(), $dbalCustomTypesClasses);

            self::$initialized = true;
        }
    }

    private static function registerType(): callable
    {
        return static function ($dbalCustomTypesClasses): void {
            Type::addType($dbalCustomTypesClasses::customTypeName(), $dbalCustomTypesClasses);
        };
    }
}
