<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Tests\Shared\Domain\UuidMother;

final class CourseIdMother
{
	public static function create(?string $value = null): CourseId
	{
		return new CourseId($value ?? UuidMother::create());
	}
}
