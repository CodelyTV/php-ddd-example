<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Domain;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseCreatedDomainEvent;
use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;

final class CourseCreatedDomainEventMother
{
	public static function create(
		?CourseId $id = null,
		?CourseName $name = null,
		?CourseDuration $duration = null
	): CourseCreatedDomainEvent {
		return new CourseCreatedDomainEvent(
			$id?->value() ?? CourseIdMother::create()->value(),
			$name?->value() ?? CourseNameMother::create()->value(),
			$duration?->value() ?? CourseDurationMother::create()->value()
		);
	}

	public static function fromCourse(Course $course): CourseCreatedDomainEvent
	{
		return self::create($course->id(), $course->name(), $course->duration());
	}
}
