<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Steps\Domain;

use CodelyTv\Mooc\Steps\Domain\StepOrder;
use CodelyTv\Test\Shared\Domain\NumberMother;

final class StepOrderMother
{
    public static function create(int $value): StepOrder
    {
        return new StepOrder($value);
    }

    public static function random(): StepOrder
    {
        return self::create(NumberMother::lessThan(10));
    }
}
