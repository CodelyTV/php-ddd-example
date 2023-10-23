<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Application\SearchAll;

use CodelyTv\Backoffice\Courses\Application\BackofficeCourseResponse;
use CodelyTv\Backoffice\Courses\Application\BackofficeCoursesResponse;
use CodelyTv\Backoffice\Courses\Domain\BackofficeCourse;
use CodelyTv\Backoffice\Courses\Domain\BackofficeCourseRepository;

use function Lambdish\Phunctional\map;

final readonly class AllBackofficeCoursesSearcher
{
	public function __construct(private BackofficeCourseRepository $repository) {}

	public function searchAll(): BackofficeCoursesResponse
	{
		return new BackofficeCoursesResponse(...map($this->toResponse(), $this->repository->searchAll()));
	}

	private function toResponse(): callable
	{
		return static fn (BackofficeCourse $course): BackofficeCourseResponse => new BackofficeCourseResponse(
			$course->id(),
			$course->name(),
			$course->duration()
		);
	}
}
