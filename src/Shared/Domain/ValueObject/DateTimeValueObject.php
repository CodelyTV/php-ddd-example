<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain\ValueObject;

abstract class DateTimeValueObject
{
    protected $value;

    public function __construct(\DateTimeInterface $value)
    {
        if(is_a($value,  \DateTime::class))
        {
            $value = \DateTimeImmutable::createFromMutable($value);
        }
        $this->value = $value;
    }

    public function value(): \DateTimeImmutable
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value()->format(\DateTime::ATOM);
    }
}
