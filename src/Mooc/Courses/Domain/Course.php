<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class Course extends AggregateRoot
{
	public function __construct(private readonly CourseId $id, private CourseName $name, private readonly CourseDuration $duration) {}

	public static function create(CourseId $id, CourseName $name, CourseDuration $duration): self
	{
		$course = new self($id, $name, $duration);

		$course->record(new CourseCreatedDomainEvent($id->value(), $name->value(), $duration->value()));

		return $course;
	}

	public function id(): CourseId
	{
		return $this->id;
	}

	public function name(): CourseName
	{
		return $this->name;
	}

	public function duration(): CourseDuration
	{
		return $this->duration;
	}

	public function rename(CourseName $newName): void
	{
		$this->name = $newName;
	}
}
