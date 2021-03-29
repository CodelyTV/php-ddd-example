<?php

declare(strict_types=1);

namespace CodelyTv\Tests\OpenFlight\Courses;

use CodelyTv\OpenFlight\Courses\Domain\CourseRepository;
use CodelyTv\Tests\OpenFlight\Shared\Infrastructure\PhpUnit\MoocContextInfrastructureTestCase;

abstract class CoursesModuleInfrastructureTestCase extends MoocContextInfrastructureTestCase
{
    protected function repository(): CourseRepository
    {
        return $this->service(CourseRepository::class);
    }
}
