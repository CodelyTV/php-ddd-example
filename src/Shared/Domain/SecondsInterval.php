<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain;

use DomainException;

final readonly class SecondsInterval
{
	public function __construct(private Second $from, private Second $to)
	{
		$this->ensureIntervalEndsAfterStart($from, $to);
	}

	public static function fromValues(int $from, int $to): self
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
