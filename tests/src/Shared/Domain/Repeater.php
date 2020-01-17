<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Shared\Domain;

use function Lambdish\Phunctional\repeat;

final class Repeater
{
    public static function repeat(callable $function, $quantity): array
    {
        return repeat($function, $quantity);
    }

    public static function repeatLessThan(callable $function, $max): array
    {
        return self::repeat($function, IntegerMother::lessThan($max));
    }

    public static function random(callable $function): array
    {
        return self::repeat($function, IntegerMother::lessThan(5));
    }
}
