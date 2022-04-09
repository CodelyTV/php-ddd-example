<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Courses\Domain\CourseNotifier;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class CoursesModuleUnitTestCase extends UnitTestCase
{
    private CourseRepository|MockInterface|null $repository;
    private CourseNotifier|MockInterface|null $notifier;

    protected function shouldSave(Course $course): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with($this->similarTo($course))
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

    protected function repository(): CourseRepository|MockInterface
    {
        return $this->repository = $this->repository ?? $this->mock(CourseRepository::class);
    }

/*Veure d'on agafa el coursenotifier aquest*/
    protected function notifier(): CourseNotifier|MockInterface
    {
        return $this->notifier = $this->notifier ?? $this->mock(CourseNotifier::class);
    }
}
