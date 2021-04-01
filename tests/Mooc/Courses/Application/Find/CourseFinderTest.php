<?php

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use CodelyTv\Mooc\Courses\Domain\Course;

class CourseFinderTest extends CoursesModuleUnitTestCase
{
    private CourseFinder $courseFinder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->courseFinder = new CourseFinder($this->repository());
    }
    
    public function testCourseFinderShouldFindAnExistingCourse()
    {
        $course = $this->givenAnExistingCourse();
        $actual = $this->whenFinderIsInvoked($course->id(), $course);
        $this->thenTheCourseShouldBeTheExpected($course, $actual);
    }
    
    private function givenAnExistingCourse(): Course
    {
        return CourseMother::create();
    }

    private function whenFinderIsInvoked(CourseId $courseId, Course $course): Course
    {
        $this->shouldSearch($courseId, $course);
        return $this->courseFinder->__invoke($course->id());
    }

    private function thenTheCourseShouldBeTheExpected(Course $course, Course $actual): void
    {
        $this->assertSimilar($course, $actual);
    }
}
