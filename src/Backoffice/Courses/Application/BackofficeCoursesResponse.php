<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Application;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class BackofficeCoursesResponse implements Response
{
	private readonly array $courses;

	public function __construct(BackofficeCourseResponse ...$courses)
	{
		$this->courses = $courses;
	}

	public function courses(): array
	{
		return $this->courses;
	}
}
