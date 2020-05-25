<?php
declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Update;

use CodelyTv\Mooc\Courses\Application\Update\CourseRenamerCommandHandler;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use CodelyTv\Tests\Shared\Domain\DuplicatorMother;

class CourseRenamerCommandTest extends CoursesModuleUnitTestCase
{
    private CourseRenamerCommandHandler $handler;

    /** @test */
    public function it_should_rename_a_course(): void
    {
        $existingCourse = CourseMother::random();
        $command        = CourseRenamerCommandMother::random();

        $updatedCourse = DuplicatorMother::with($existingCourse,
            [
                'name' => new CourseName($command->getNewName())
            ]);

        $this->shouldSearch($existingCourse->id(), $existingCourse);
        $this->shouldSave($updatedCourse);
        $this->shouldNotPublishDomainEvent();

        $this->dispatch($command, $this->handler);
    }
}
