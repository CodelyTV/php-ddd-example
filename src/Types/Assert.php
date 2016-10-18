<?php

namespace CodelyTv\Types;

use InvalidArgumentException;

final class Assert
{
    public static function arrayOf(string $class, array $items)
    {
        foreach ($items as $item) {
            self::instanceOf($class, $item);
        }
    }

    public static function instanceOf($class, $item)
    {
        if (!$item instanceof $class) {
            throw new InvalidArgumentException(
                sprintf('The object <%s> is not an instance of <%s>', $class, get_class($item))
            );
        }
    }

    public static function money($value)
    {
        if (!self::isValidMoneyAmount($value)) {
            throw new InvalidArgumentException(sprintf('The value <%s> is not a valid money amount', $value));
        }
    }

    private static function isValidMoneyAmount($value)
    {
        return is_numeric($value) && $value >= 0;
    }
}
