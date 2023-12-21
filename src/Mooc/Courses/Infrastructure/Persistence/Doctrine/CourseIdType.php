<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Infrastructure\Persistence\Doctrine;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\UuidType;
use Override;

final class CourseIdType extends UuidType
{
	#[Override]
	protected function typeClassName(): string
	{
		return CourseId::class;
	}
}
