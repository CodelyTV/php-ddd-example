<?php

namespace CodelyTv\Test\Shared\Domain;

final class NumberStub
{
    public static function between($min, $max = PHP_INT_MAX)
    {
        return StubCreator::random()->numberBetween($min, $max);
    }

    public static function lessThan($max)
    {
        return self::between(1, $max);
    }

    public static function moreThan($min)
    {
        return self::between($min);
    }

    public static function float($numDecimals = null)
    {
        return StubCreator::random()->randomFloat($numDecimals);
    }

    public static function floatBetween($min, $max, $numDecimals = null)
    {
        return StubCreator::random()->randomFloat($numDecimals, $min, $max);
    }

    public static function randomPercentage()
    {
        return self::between(0, 100);
    }

    public static function randomPositive()
    {
        return self::between(0, 1000);
    }

    public static function random()
    {
        return self::between(1);
    }
}
