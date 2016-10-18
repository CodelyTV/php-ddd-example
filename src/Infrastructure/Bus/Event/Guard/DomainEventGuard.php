<?php

namespace CodelyTv\Infrastructure\Bus\Event\Guard;

use DomainException;
use CodelyTv\Types\Validator;
use function Lambdish\Phunctional\all;

final class DomainEventGuard
{
    public static function guard(array $data, array $rules, string $eventClass)
    {
        if (!self::isValid($data, $rules)) {
            throw new DomainException(sprintf('Error constructing <%s>', $eventClass));
        }
    }

    private static function isValid(array $data, array $rules) : bool
    {
        return self::hasAllParameters($data, $rules) && all(self::parameterIsValid($data), $rules);
    }

    private static function hasAllParameters(array $data, array $rules) : bool
    {
        return empty(array_diff_key($rules, $data));
    }

    private static function parameterIsValid(array $data)
    {
        return function (array $meta, string $attribute) use ($data) {
            return Validator::isValid($data[$attribute], self::extractType($meta));
        };
    }

    private static function extractType(array $meta)
    {
        return $meta[0];
    }
}
