<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\Course\Application\Create;

use CodelyTv\Context\Course\Module\Course\Application\Update\CourseUpdater;
use CodelyTv\Test\Context\Course\Module\Course\CourseModuleUnitTestCase;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseDescriptionStub;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseStub;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseTitleStub;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseUpdatedDomainEventStub;

final class UpdateCourseTest extends CourseModuleUnitTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->courseUpdater = new CourseUpdater($this->repository(), $this->domainEventPublisher());
    }

    /** @test */
    public function it_should_update_a_course()
    {
        $id = CourseIdStub::random();
        $title = CourseTitleStub::random();
        $description = CourseDescriptionStub::random();

        $course = CourseStub::create($id, $title, $description);

        $this->shouldSaveCourse($course);
        $this->shouldSearchCourse($id, $course);

        $this->shouldPublishDomainEvents(
            CourseUpdatedDomainEventStub::create($id, $title, $description)
        );

        $this->courseUpdater->update($id, $title, $description);
    }
}
