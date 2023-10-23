<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses;

use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Tests\Mooc\Shared\Infrastructure\PhpUnit\MoocContextInfrastructureTestCase;

abstract class CoursesModuleInfrastructureTestCase extends MoocContextInfrastructureTestCase
{
	protected function repository(): CourseRepository
	{
		return $this->service(CourseRepository::class);
	}
}
