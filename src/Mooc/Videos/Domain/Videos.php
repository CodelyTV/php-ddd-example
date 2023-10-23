<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\Collection;

final class Videos extends Collection
{
	protected function type(): string
	{
		return Video::class;
	}
}
