<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final readonly class FindVideoQuery implements Query
{
	public function __construct(private string $id) {}

	public function id(): string
	{
		return $this->id;
	}
}
