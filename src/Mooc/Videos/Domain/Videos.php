<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\Collection;
use Override;

final class Videos extends Collection
{
	#[Override]
	protected function type(): string
	{
		return Video::class;
	}
}
