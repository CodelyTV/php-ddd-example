<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain;

use InvalidArgumentException;

final class Assert
{
    public static function arrayOf(string $class, array $items): void
    {
        foreach ($items as $item) {
            self::instanceOf($class, $item);
        }
    }

    public static function instanceOf($class, $item): void
    {
        if (!$item instanceof $class) {
            throw new InvalidArgumentException(
                sprintf('The object <%s> is not an instance of <%s>', $class, get_class($item))
            );
        }
    }

    public static function money($value): void
    {
        if (!self::isValidMoneyAmount($value)) {
            throw new InvalidArgumentException(sprintf('The value <%s> is not a valid money amount', $value));
        }
    }

    private static function isValidMoneyAmount($value): bool
    {
        return is_numeric($value) && $value >= 0;
    }
}
