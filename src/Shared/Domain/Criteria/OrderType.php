<?php

namespace CodelyTv\Shared\Domain\Criteria;

use CodelyTv\Types\ValueObject\Enum;
use InvalidArgumentException;

/**
 * @method static OrderType asc()
 * @method static OrderType desc()
 */
final class OrderType extends Enum
{
    const ASC  = 'asc';
    const DESC = 'desc';

    protected function throwExceptionForInvalidValue($value)
    {
        throw new InvalidArgumentException($value);
    }
}
