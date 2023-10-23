<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Infrastructure\Bus\Query;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final readonly class FakeResponse implements Response
{
	public function __construct(private int $number) {}

	public function number(): int
	{
		return $this->number;
	}
}
