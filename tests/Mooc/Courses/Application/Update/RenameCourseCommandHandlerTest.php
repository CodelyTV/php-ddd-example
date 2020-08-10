<?php

namespace CodelyTv\Tests\Mooc\Courses\Application\Update;

use CodelyTv\Mooc\Courses\Application\Update\CourseRenamer;
use CodelyTv\Mooc\Courses\Application\Update\RenameCourseCommandHandler;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseNameMother;
use CodelyTv\Tests\Shared\Domain\DuplicatorMother;

final class RenameCourseCommandHandlerTest extends CoursesModuleUnitTestCase
{
    private RenameCourseCommandHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new RenameCourseCommandHandler(
            new CourseRenamer($this->repository(), $this->eventBus())
        );
    }

    /** @test **/
    public function it_should_rename_an_existing_course()
    {
        $course        = CourseMother::random();
        $command       = RenameCourseCommandMother::withId($course->id());
        $renamedCourse = DuplicatorMother::with(
            $course, ['name' => CourseNameMother::create($command->newName())]
        );

        $this->shouldSearch($course->id(), $course);
        $this->shouldSave($renamedCourse);
        $this->shouldNotPublishDomainEvent();

        $this->dispatch($command, $this->handler);
    }

    /** @test **/
    public function it_should_throw_an_exception_when_the_course_not_exist(): void
    {
        $this->expectException(CourseNotExist::class);

        $id      = CourseIdMother::random();
        $command = RenameCourseCommandMother::withId($id);

        $this->shouldSearch($id, null);

        $this->dispatch($command, $this->handler);
    }
}
