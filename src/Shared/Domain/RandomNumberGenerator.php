<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain;

interface RandomNumberGenerator
{
	public function generate(): int;
}
