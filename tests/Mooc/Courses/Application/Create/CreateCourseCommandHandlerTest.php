<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Application\Create\CourseCreator;
use CodelyTv\Mooc\Courses\Application\Create\CreateCourseCommandHandler;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseCreatedDomainEventMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;

final class CreateCourseCommandHandlerTest extends CoursesModuleUnitTestCase
{
	private CreateCourseCommandHandler|null $handler;

	protected function setUp(): void
	{
		parent::setUp();

		$this->handler = new CreateCourseCommandHandler(new CourseCreator($this->repository(), $this->eventBus()));
	}

	/** @test */
	public function it_should_create_a_valid_course(): void
	{
		$command = CreateCourseCommandMother::create();

		$course = CourseMother::fromRequest($command);
		$domainEvent = CourseCreatedDomainEventMother::fromCourse($course);

		$this->shouldSave($course);
		$this->shouldPublishDomainEvent($domainEvent);

		$this->dispatch($command, $this->handler);
	}
}
