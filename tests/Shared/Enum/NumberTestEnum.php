<?php

namespace CodelyTv\Test\Shared\Enum;

use CodelyTv\Types\ValueObject\Enum;

/**
 * @method static NumberTestEnum one()
 * @method static NumberTestEnum two()
 */
final class NumberTestEnum extends Enum
{
    const ONE = 1;
    const TWO = 2;

    protected function throwExceptionForInvalidValue($unused)
    {
        // Not necessary for the test
    }
}
