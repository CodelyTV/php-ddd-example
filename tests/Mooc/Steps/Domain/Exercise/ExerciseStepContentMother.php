<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Steps\Domain\Exercise;

use CodelyTv\Mooc\Steps\Domain\Exercise\ExerciseStepContent;
use CodelyTv\Tests\Shared\Domain\WordMother;

final class ExerciseStepContentMother
{
	public static function create(?string $value = null): ExerciseStepContent
	{
		return new ExerciseStepContent($value ?? WordMother::create());
	}
}
