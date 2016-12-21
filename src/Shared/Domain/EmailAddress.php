<?php

namespace CodelyTv\Shared\Domain;

use InvalidArgumentException;

final class EmailAddress
{
    private $value;

    public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    private function guard(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('The email <%s> is not valid'));
        }
    }

    public function value(): string
    {
        return $this->value;
    }


}
