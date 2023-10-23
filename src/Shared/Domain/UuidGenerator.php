<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain;

interface UuidGenerator
{
	public function generate(): string;
}
