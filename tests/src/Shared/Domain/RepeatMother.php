<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

use function Lambdish\Phunctional\repeat;

final class RepeatMother
{
    public static function repeat(callable $function, $quantity): array
    {
        return repeat($function, $quantity);
    }

    public static function repeatLessThan(callable $function, $max): array
    {
        return self::repeat($function, NumberMother::lessThan($max));
    }

    public static function random(callable $function): array
    {
        return self::repeat($function, NumberMother::lessThan(5));
    }
}
