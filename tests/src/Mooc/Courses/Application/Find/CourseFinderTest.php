<?php

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;

class CourseFinderTest extends CoursesModuleUnitTestCase
{
    private CourseFinder $finder;

    public function setUp(): void
    {
        $this->finder = new CourseFinder($this->repository());
    }

    /** @test */
    public function should_find_an_existing_course()
    {
        $course = CourseMother::random();
        $this->shouldSearch($course->id(), $course);

        $foundCourse = $this->finder->__invoke($course->id());

        $this->assertSimilar($course, $foundCourse);
    }

    /** @test */
    public function should_fail_when_the_course_does_not_exist()
    {
        $this->expectException(CourseNotExist::class);

        $nonExistingCourseId = CourseIdMother::random();
        $this->shouldSearch($nonExistingCourseId, null);

        $this->finder->__invoke($nonExistingCourseId);
    }
}
