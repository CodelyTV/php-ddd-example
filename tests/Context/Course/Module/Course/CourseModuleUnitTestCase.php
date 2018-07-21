<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\Course;

use CodelyTv\Context\Course\Module\Course\Domain\Course;
use CodelyTv\Context\Course\Module\Course\Domain\CourseRepository;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Context\Course\CourseContextUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\similarTo;
use function CodelyTv\Test\equalTo;

abstract class CourseModuleUnitTestCase extends CourseContextUnitTestCase
{
    private $repository;

    /** @return VideoRepository|MockInterface */
    protected function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(CourseRepository::class);
    }

    protected function shouldSaveCourse(Course $course)
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(similarTo($course))
            ->once()
            ->andReturnNull();
    }

    protected function shouldSearchCourse(CourseId $id, Course $course = null)
    {
        $this->repository()
            ->shouldReceive('search')
            ->with(equalTo($id))
            ->once()
            ->andReturn($course);
    }
}
