<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Enum;

use CodelyTv\Shared\Domain\ValueObject\Enum;

/**
 * @method static StringTestEnum one()
 * @method static StringTestEnum two()
 * @method static StringTestEnum aVeryLargeNumber()
 */
final class StringTestEnum extends Enum
{
    public const ONE                 = 'one';
    public const TWO                 = 'two';
    public const A_VERY_LARGE_NUMBER = 'A very large number';

    protected function throwExceptionForInvalidValue($unused): void
    {
        // Not necessary for the test
    }
}
