<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain\ValueObject;

use DateTimeImmutable;
use InvalidArgumentException;

abstract class DateTimeObject
{
    protected $value;

    public function __construct(int $timestamp)
    {
        $valueToSet = DateTimeImmutable::date_timestamp_set($timestamp);
        $this->ensureValidDateTime($valueToSet);

        $this->value = $valueToSet;
    }

    private function ensureValidDateTime($dateTime): void {
        if(is_bool($dateTime)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $dateTime)
            );
        }
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equalsTo(DateTimeObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function isBiggerThan(DateTimeObject $other): bool
    {
        return $this->value() > $other->value();
    }

    public static function now(): DateTimeObject {
        return new static(time());
    }
}
