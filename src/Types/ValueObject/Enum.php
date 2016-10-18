<?php

namespace CodelyTv\Types\ValueObject;

use ReflectionClass;
use function CodelyTv\Utils\snake_to_camel;
use function Lambdish\Phunctional\reindex;

abstract class Enum
{
    protected static $cache = [];
    protected $value;

    public function __construct($value)
    {
        $this->guard($value);
        $this->value = $value;
    }

    abstract protected function throwExceptionForInvalidValue($value);

    public static function __callStatic($name, $args)
    {
        return new static(self::values()[$name]);
    }

    public static function fromString($value)
    {
        return new static($value);
    }

    public static function values()
    {
        $class = get_called_class();

        if (!isset(self::$cache[$class])) {
            $reflected           = new ReflectionClass($class);
            self::$cache[$class] = reindex(self::keysFormatter(), $reflected->getConstants());
        }

        return self::$cache[$class];
    }

    public static function randomValue()
    {
        return self::values()[array_rand(self::values())];
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(Enum $other)
    {
        return $other == $this;
    }

    protected function guard($value)
    {
        if (!static::isValid($value)) {
            $this->throwExceptionForInvalidValue($value);
        }
    }

    protected static function isValid($value)
    {
        return in_array($value, static::values(), true);
    }

    public static function random()
    {
        return new static(self::randomValue());
    }

    private static function keysFormatter()
    {
        return function ($unused, $key) {
            return snake_to_camel(strtolower($key));
        };
    }

    public function __toString()
    {
        return (string) $this->value();
    }
}
