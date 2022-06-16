<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain;

use DomainException;

final class SecondsInterval
{
    public function __construct(private readonly Second $from, private readonly Second $to)
    {
        $this->ensureIntervalEndsAfterStart($from, $to);
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
