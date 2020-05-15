<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Mooc\Courses;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Mooc\Shared\Domain\Logger;
use CodelyTv\Mooc\Shared\Domain\LogLevel;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class CoursesModuleUnitTestCase extends UnitTestCase
{
    private $repository;

    private $logger;

    protected function shouldSave(Course $course): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with($this->similarTo($course))
            ->once()
            ->andReturnNull();
    }

    protected function shouldLogCourseCreation(Course $course): void
    {
        $logMessage = sprintf(
            "Course named %s with id %s has been created)",
            $course->name(),
            $course->id()
        );

        $this->logger()
            ->shouldReceive('log')
            // ->with( LogLevel::INFO, $logMessage )
            // ->withArgs( [ LogLevel::INFO, $logMessage ] )
            ->once()
            ->andReturnNull();
    }

    protected function shouldSearch(CourseId $id, ?Course $course): void
    {
        $this->repository()
            ->shouldReceive('search')
            ->with($this->similarTo($id))
            ->once()
            ->andReturn($course);
    }

    /** @return CourseRepository|MockInterface */
    protected function repository(): MockInterface
    {
        return $this->repository = $this->repository ?: $this->mock(CourseRepository::class);
    }

    /** @return Logger|MockInterface */
    protected function logger(): MockInterface
    {
        return $this->logger = $this->logger ?: $this->mock(Logger::class);
    }
}
