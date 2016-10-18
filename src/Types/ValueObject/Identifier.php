<?php

namespace CodelyTv\Types\ValueObject;

use InvalidArgumentException;

class Identifier extends StringValueObject
{
    public function __construct($id)
    {
        $this->guard($id);

        parent::__construct($id);
    }

    private function guard($id)
    {
        if (!$this->isValid($id)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the identifier <%s>.', static::class, is_scalar($id) ? $id : gettype($id))
            );
        }
    }

    private function isValid($id) : bool
    {
        return is_int($id) || is_string($id);
    }
}
