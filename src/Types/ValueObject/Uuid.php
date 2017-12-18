<?php

declare(strict_types=1);

namespace CodelyTv\Types\ValueObject;

use InvalidArgumentException;
use Rhumsaa\Uuid\Uuid as RhumsaaUuid;

class Uuid
{
    private $value;

    public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    public static function random(): self
    {
        return new self(RhumsaaUuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    private function guard($id): void
    {
        if (!RhumsaaUuid::isValid($id)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, is_scalar($id) ? $id : gettype($id))
            );
        }
    }

    public function __toString()
    {
        return $this->value();
    }
}
