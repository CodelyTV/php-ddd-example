<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

final class NumberMother
{
    public static function between($min, $max = PHP_INT_MAX): int
    {
        return MotherCreator::random()->numberBetween($min, $max);
    }

    public static function lessThan($max): int
    {
        return self::between(1, $max);
    }

    public static function moreThan($min): int
    {
        return self::between($min);
    }

    public static function float($numDecimals = null): float
    {
        return MotherCreator::random()->randomFloat($numDecimals);
    }

    public static function floatBetween($min, $max, $numDecimals = null): float
    {
        return MotherCreator::random()->randomFloat($numDecimals, $min, $max);
    }

    public static function randomPercentage(): int
    {
        return self::between(0, 100);
    }

    public static function randomPositive(): int
    {
        return self::between(0, 1000);
    }

    public static function random(): int
    {
        return self::between(1);
    }
}
