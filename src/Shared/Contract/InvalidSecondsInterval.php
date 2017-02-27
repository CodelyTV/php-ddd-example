<?php

namespace CodelyTv\Shared\Contract;

use CodelyTv\Exception\DomainError;
use CodelyTv\Shared\Domain\Second;

final class InvalidSecondsInterval extends DomainError
{
    private $from;
    private $to;

    public function __construct(Second $from, Second $to)
    {
        $this->from = $from;
        $this->to   = $to;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_seconds_interval';
    }

    protected function errorMessage(): string
    {
        return sprintf('The interval <%s -> %s> is invalid', $this->from->value(), $this->to->value());
    }
}
