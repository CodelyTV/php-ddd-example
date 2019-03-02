<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain;

use DomainException;

final class SecondsInterval
{
    private $from;
    private $to;

    public function __construct(Second $from, Second $to)
    {
        $this->ensureIntervalEndsAfterStart($from, $to);

        $this->from = $from;
        $this->to   = $to;
    }

    public function from(): Second
    {
        return $this->from;
    }

    public function to(): Second
    {
        return $this->to;
    }

    public static function fromValues(int $from, int $to): SecondsInterval
    {
        return new self(new Second($from), new Second($to));
    }

    private function ensureIntervalEndsAfterStart(Second $from, Second $to): void
    {
        if ($from->isBiggerThan($to)) {
            throw new DomainException('To is bigger than from');
        }
    }
}
