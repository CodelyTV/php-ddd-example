<?php

namespace CodelyTv\Types;

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

    private static function stringValidator()
    {
        return function ($value) {
            return is_string($value);
        };
    }

    private static function intValidator()
    {
        return function ($value) {
            return is_int($value);
        };
    }

    private static function arrayValidator()
    {
        return function ($value) {
            return is_array($value);
        };
    }

    private static function floatValidator()
    {
        return function ($value) {
            return is_float($value);
        };
    }
}
