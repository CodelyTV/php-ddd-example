<?php

namespace CodelyTv\Context\Video\Module\Review\Domain;

final class ReviewValidated
{
    private $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function value(): bool
    {
        return $this->value;
    }
}
