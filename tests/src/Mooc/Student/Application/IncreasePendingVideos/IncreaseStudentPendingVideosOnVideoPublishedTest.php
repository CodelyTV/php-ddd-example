<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Student\Application\IncreasePendingVideos;

use CodelyTv\Mooc\Student\Application\IncreasePendingVideos\IncreaseStudentTotalVideosCreatedOnVideoCreated;
use CodelyTv\Mooc\Student\Application\IncreasePendingVideos\StudentTotalVideosCreatedIncreaser;
use CodelyTv\Test\Mooc\Student\Domain\ScalaVideoCreatedDomainEventMother;
use CodelyTv\Test\Mooc\Student\Domain\StudentTotalVideosCreatedMother;
use CodelyTv\Test\Mooc\Student\Domain\StudentIdMother;
use CodelyTv\Test\Mooc\Student\Domain\StudentMother;
use CodelyTv\Test\Mooc\Student\StudentModuleUnitTestCase;
use CodelyTv\Test\Shared\Domain\DuplicatorMother;

final class IncreaseStudentPendingVideosOnVideoPublishedTest extends StudentModuleUnitTestCase
{
    /** @var IncreaseStudentTotalVideosCreatedOnVideoCreated */
    private $subscriber;

    protected function setUp()
    {
        parent::setUp();

        $increaser = new StudentTotalVideosCreatedIncreaser($this->repository());

        $this->subscriber = new IncreaseStudentTotalVideosCreatedOnVideoCreated($increaser);
    }

    /** @test */
    public function it_should_increase_student_total_videos_created_on_scala_video_created()
    {
        $event = ScalaVideoCreatedDomainEventMother::random();

        $id = StudentIdMother::create($event->creatorId());
        $student = StudentMother::withId($id);

        $updatedStudent = DuplicatorMother::with(
            $student,
            ['totalVideosCreated' => StudentTotalVideosCreatedMother::create($student->totalVideosCreated()->value() + 1)]
        );

        $this->shouldSearchStudent($id, $student);
        $this->shouldSaveStudent($updatedStudent);

        $this->notify($event, $this->subscriber);
    }
}
