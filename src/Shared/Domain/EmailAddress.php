<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain;

use InvalidArgumentException;

final class EmailAddress
{
    private $value;

    public function __construct(string $value)
    {
        $this->ensureIsValidEmail($value);

        $this->value = $value;
    }

    private function ensureIsValidEmail(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('The email <%s> is not valid', $value));
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
