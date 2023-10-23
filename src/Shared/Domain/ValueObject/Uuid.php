<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Stringable;

abstract class Uuid implements Stringable
{
	final public function __construct(protected string $value)
	{
		$this->ensureIsValidUuid($value);
	}

	final public static function random(): self
	{
		return new static(RamseyUuid::uuid4()->toString());
	}

	final public function value(): string
	{
		return $this->value;
	}

	final public function equals(self $other): bool
	{
		return $this->value() === $other->value();
	}

	public function __toString(): string
	{
		return $this->value();
	}

	private function ensureIsValidUuid(string $id): void
	{
		if (!RamseyUuid::isValid($id)) {
			throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', self::class, $id));
		}
	}
}
