<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\ValueObject;

use CodelyTv\Shared\Domain\Utils;
use ReflectionClass;
use Stringable;

use function in_array;
use function Lambdish\Phunctional\reindex;

abstract class Enum implements Stringable
{
    protected static array $cache = [];

    public function __construct(protected $value)
    {
        $this->ensureIsBetweenAcceptedValues($value);
    }

    abstract protected function throwExceptionForInvalidValue($value);

    public static function __callStatic(string $name, $args)
    {
        return new static(self::values()[$name]);
    }

    final public static function fromString(string $value): self
    {
        return new static($value);
    }

    final public static function values(): array
    {
        $class = static::class;

        if (!isset(self::$cache[$class])) {
            $reflected = new ReflectionClass($class);
            self::$cache[$class] = reindex(self::keysFormatter(), $reflected->getConstants());
        }

        return self::$cache[$class];
    }

    final public static function randomValue()
    {
        return self::values()[array_rand(self::values())];
    }

    final public static function random(): static
    {
        return new static(self::randomValue());
    }

    private static function keysFormatter(): callable
    {
        return static fn ($unused, string $key): string => Utils::toCamelCase(strtolower($key));
    }

    final public function value()
    {
        return $this->value;
    }

    final public function equals(self $other): bool
    {
        return $other->value() === $this->value();
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }

    private function ensureIsBetweenAcceptedValues($value): void
    {
        if (!in_array($value, static::values(), true)) {
            $this->throwExceptionForInvalidValue($value);
        }
    }
}
