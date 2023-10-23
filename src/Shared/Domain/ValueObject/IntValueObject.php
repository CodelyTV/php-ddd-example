<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\ValueObject;

abstract class IntValueObject
{
	public function __construct(protected int $value) {}

	final public function value(): int
	{
		return $this->value;
	}

	final public function isBiggerThan(self $other): bool
	{
		return $this->value() > $other->value();
	}
}
