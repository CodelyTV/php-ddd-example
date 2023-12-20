<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Steps\Domain;

use CodelyTv\Mooc\Steps\Domain\StepTitle;
use CodelyTv\Tests\Shared\Domain\WordMother;

final class StepTitleMother
{
	public static function create(?string $value = null): StepTitle
	{
		return new StepTitle($value ?? WordMother::create());
	}
}
