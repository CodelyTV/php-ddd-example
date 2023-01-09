<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\ValueObject;

abstract class DateValueObject
{
    public function __construct(protected string $value)
    {
        $this->ensureIsValidDate($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    private function ensureIsValidDate(string $value): void
    {
        if (false === strtotime($value)) {
            throw new \InvalidArgumentException(sprintf('<%s> does not allow the value <%s>', static::class, $value));
        }
    }

    public function isBiggerThan(DateValueObject $date): bool
    {
        return $this->value() > $date->value();
    }

    public function isSmallerThan(DateValueObject $date): bool
    {
        return $this->value() < $date->value();
    }

    public function equals(DateValueObject $date): bool
    {
        return new \DateTimeImmutable($this->value()) == new \DateTimeImmutable($date->value());
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
