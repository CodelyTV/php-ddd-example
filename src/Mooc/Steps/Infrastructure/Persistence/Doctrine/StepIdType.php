<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Steps\Infrastructure\Persistence\Doctrine;

use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class StepIdType extends UuidType
{
	protected function typeClassName(): string
	{
		return StepId::class;
	}
}
