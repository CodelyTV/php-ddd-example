<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Application\Create\CreateCourseCommand;
use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseDurationMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseNameMother;

final class CreateCourseCommandMother
{
	public static function create(
		?CourseId $id = null,
		?CourseName $name = null,
		?CourseDuration $duration = null
	): CreateCourseCommand {
		return new CreateCourseCommand(
			$id?->value() ?? CourseIdMother::create()->value(),
			$name?->value() ?? CourseNameMother::create()->value(),
			$duration?->value() ?? CourseDurationMother::create()->value()
		);
	}
}
