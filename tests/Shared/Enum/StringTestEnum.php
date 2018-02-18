<?php

namespace CodelyTv\Test\Shared\Enum;

use CodelyTv\Types\ValueObject\Enum;

/**
 * @method static StringTestEnum one()
 * @method static StringTestEnum two()
 * @method static StringTestEnum aVeryLargeNumber()
 */
final class StringTestEnum extends Enum
{
    const ONE                 = 'one';
    const TWO                 = 'two';
    const A_VERY_LARGE_NUMBER = 'A very large number';

    protected function throwExceptionForInvalidValue($unused)
    {
        // Not necessary for the test
    }
}
