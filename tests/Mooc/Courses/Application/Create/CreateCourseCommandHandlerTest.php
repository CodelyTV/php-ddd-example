<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Application\Create\CourseCreator;
use CodelyTv\Mooc\Courses\Application\Create\CreateCourseCommandHandler;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseGenerationNotificator;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseCreatedDomainEventMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use Mockery\MockInterface;

final class CreateCourseCommandHandlerTest extends CoursesModuleUnitTestCase
{
    private $handler;
    private $courseGenerationNotificator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new CreateCourseCommandHandler(
            new CourseCreator(
                $this->repository(),
                $this->eventBus(),
                $this->courseGenerationNotificator()
            )
        );
    }

    /** @test */
    public function it_should_create_a_valid_course(): void
    {
        $command = CreateCourseCommandMother::random();

        $course      = CourseMother::fromRequest($command);
        $domainEvent = CourseCreatedDomainEventMother::fromCourse($course);

        $this->shouldSave($course);
        $this->shouldPublishDomainEvent($domainEvent);
        $this->shouldNotifyTheGeneration($course);

        $this->dispatch($command, $this->handler);
    }

    /** @return CourseGenerationNotificator|MockInterface */
    protected function courseGenerationNotificator(): MockInterface
    {
        return $this->courseGenerationNotificator = $this->courseGenerationNotificator ?: $this->mock(CourseGenerationNotificator::class);
    }

    protected function shouldNotifyTheGeneration(Course $withCourse)
    {
        $this->courseGenerationNotificator()
            ->shouldReceive('notifyCourseCreated')
            ->once()
            ->with($this->similarTo($withCourse));
    }
}
