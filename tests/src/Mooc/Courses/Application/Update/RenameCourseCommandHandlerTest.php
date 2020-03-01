<?php

namespace CodelyTv\Tests\Mooc\Courses\Application\Update;

use CodelyTv\Mooc\Courses\Application\Update\CourseRenamer;
use CodelyTv\Mooc\Courses\Application\Update\RenameCourseCommandHandler;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseNameMother;

final class RenameCourseCommandHandlerTest extends CoursesModuleUnitTestCase
{
    private $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new RenameCourseCommandHandler(
            new CourseRenamer($this->repository(), $this->eventBus())
        );
    }

    /** @test */
    public function it_should_rename_an_existing_course()
    {
        $existingCourse = CourseMother::random();
        $command = RenameCourseCommandMother::fromCourse($existingCourse);

        $updatedCourse = CourseMother::create(
            $existingCourse->id(),
            CourseNameMother::create($command->newName()),
            $existingCourse->duration()
        );

        $this->shouldSearch($existingCourse->id(), $existingCourse);
        $this->shouldSave($updatedCourse);
        $this->shouldNotPublishDomainEvent();

        $this->dispatch($command, $this->handler);
    }
}