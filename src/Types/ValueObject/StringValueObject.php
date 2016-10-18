<?php

namespace CodelyTv\Types\ValueObject;

abstract class StringValueObject
{
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value();
    }
}
