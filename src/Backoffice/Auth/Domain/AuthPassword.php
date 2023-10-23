<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Auth\Domain;

use CodelyTv\Shared\Domain\ValueObject\StringValueObject;

final class AuthPassword extends StringValueObject
{
	public function isEquals(self $other): bool
	{
		return $this->value() === $other->value();
	}
}
