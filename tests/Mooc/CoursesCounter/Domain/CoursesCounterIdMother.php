<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\CoursesCounter\Domain;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterId;
use CodelyTv\Tests\Shared\Domain\UuidMother;

final class CoursesCounterIdMother
{
	public static function create(?string $value = null): CoursesCounterId
	{
		return new CoursesCounterId($value ?? UuidMother::create());
	}
}
