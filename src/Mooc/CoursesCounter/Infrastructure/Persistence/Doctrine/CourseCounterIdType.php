<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\CoursesCounter\Infrastructure\Persistence\Doctrine;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterId;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\UuidType;
use Override;

final class CourseCounterIdType extends UuidType
{
	#[Override]
	protected function typeClassName(): string
	{
		return CoursesCounterId::class;
	}
}
