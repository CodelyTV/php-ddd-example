<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Backoffice\Courses\Domain;

use CodelyTv\Backoffice\Courses\Domain\BackofficeCourse;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseDurationMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseNameMother;

final class BackofficeCourseMother
{
	public static function create(?string $id = null, ?string $name = null, ?string $duration = null): BackofficeCourse
	{
		return new BackofficeCourse(
			$id ?? CourseIdMother::create()->value(),
			$name ?? CourseNameMother::create()->value(),
			$duration ?? CourseDurationMother::create()->value()
		);
	}
}
