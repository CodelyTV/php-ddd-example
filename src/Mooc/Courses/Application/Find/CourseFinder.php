<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;

final readonly class CourseFinder
{
	public function __construct(private CourseRepository $repository) {}

	public function __invoke(CourseId $id): Course
	{
		$course = $this->repository->search($id);

		if ($course === null) {
			throw new CourseNotExist($id);
		}

		return $course;
	}
}
