<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain;

final class Validator
{
    public static function isValid($value, $type)
    {
        $validator = self::validatorFor($type);

        return $validator($value);
    }

    private static function validatorFor(string $type)
    {
        $validators = [
            'string' => self::stringValidator(),
            'int'    => self::intValidator(),
            'float'  => self::floatValidator(),
            'array'  => self::arrayValidator(),
        ];

        return $validators[$type];
    }

    private static function stringValidator(): callable
    {
        return function ($value): bool {
            return is_string($value);
        };
    }

    private static function intValidator(): callable
    {
        return function ($value): bool {
            return is_int($value);
        };
    }

    private static function arrayValidator(): callable
    {
        return function ($value): bool {
            return is_array($value);
        };
    }

    private static function floatValidator(): callable
    {
        return function ($value): bool {
            return is_float($value);
        };
    }
}
