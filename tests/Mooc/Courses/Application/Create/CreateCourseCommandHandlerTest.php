<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Application\Create\CourseCreator;
use CodelyTv\Mooc\Courses\Application\Create\CreateCourseCommandHandler;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseCreatedDomainEventMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use CodelyTv\Mooc\Courses\Domain\CourseDuplicated;

final class CreateCourseCommandHandlerTest extends CoursesModuleUnitTestCase
{
    private $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new CreateCourseCommandHandler(new CourseCreator($this->repository(), $this->eventBus()));
    }

    /** @test */
    public function it_should_create_a_valid_course(): void
    {
        $command = CreateCourseCommandMother::random();

        $course      = CourseMother::fromRequest($command);
        $domainEvent = CourseCreatedDomainEventMother::fromCourse($course);

        $this->shouldSearch($course->id(),null);
        $this->shouldSave($course);
        $this->shouldPublishDomainEvent($domainEvent);

        $this->dispatch($command, $this->handler);
    }

    /** @test */
    public function it_should_trown_an_exception_when_the_course_is_duplicated(): void
    {
        $this->expectException(CourseDuplicated::class);
        
        $command = CreateCourseCommandMother::random();
        $course = CourseMother::fromRequest($command);

        $this->shouldSearch($course->id(), $course);

        $this->dispatch($command, $this->handler);
          
    }
}
