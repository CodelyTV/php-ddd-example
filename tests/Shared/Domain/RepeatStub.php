<?php

namespace CodelyTv\Test\Shared\Domain;

use function Lambdish\Phunctional\repeat;

final class RepeatStub
{
    public static function repeat(callable $function, $quantity) : array
    {
        return repeat($function, $quantity);
    }

    public static function repeatLessThan(callable $function, $max) : array
    {
        return self::repeat($function, NumberStub::lessThan($max));
    }

    public static function random(callable $function)
    {
        return self::repeat($function, NumberStub::lessThan(5));
    }
}
