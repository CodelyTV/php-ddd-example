<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Steps\Domain;

use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Tests\Shared\Domain\UuidMother;

final class StepIdMother
{
	public static function create(?string $value = null): StepId
	{
		return new StepId($value ?? UuidMother::create());
	}
}
