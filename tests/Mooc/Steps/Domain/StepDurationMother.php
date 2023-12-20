<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Steps\Domain;

use CodelyTv\Mooc\Steps\Domain\StepDuration;
use CodelyTv\Tests\Shared\Domain\IntegerMother;

final class StepDurationMother
{
	public static function create(?int $value = null): StepDuration
	{
		return new StepDuration($value ?? IntegerMother::between(1, 1000));
	}
}
