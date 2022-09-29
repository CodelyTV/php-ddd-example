<?php

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Tests\Mooc\Courses\Application\Create\CreateCourseCommandMother;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;

class CourseFinderTest extends CoursesModuleUnitTestCase
{
    private CourseFinder|null $courseFinder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->courseFinder = new CourseFinder($this->repository());
    }

    /** @test */
    public function it_should_search_a_course(): void
    {
        $command = CreateCourseCommandMother::create();
        $course = CourseMother::fromRequest($command);

        $this->shouldSearch($course->id(), $course);
        $actual = $this->executeFinder($this->courseFinder, $course->id());
        self::assertEquals($course, $actual);
    }

    /** @test */
    public function it_search_a_course_but_it_is_not_found(): void
    {
        $this->expectException(CourseNotExist::class);
        $command = CreateCourseCommandMother::create();
        $course = CourseMother::fromRequest($command);

        $this->shouldSearch($course->id(), null);
        $this->executeFinder($this->courseFinder, $course->id());
    }

    private function executeFinder(CourseFinder $finder, CourseId $courseId): Course
    {
        return ($finder)($courseId);
    }
}

