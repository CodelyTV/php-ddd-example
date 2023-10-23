<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;

interface CourseRepository
{
	public function save(Course $course): void;

	public function search(CourseId $id): ?Course;
}
