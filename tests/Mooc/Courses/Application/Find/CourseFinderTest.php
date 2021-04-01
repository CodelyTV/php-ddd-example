<?php

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
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
        $course = $this->givenACourse();
        $actual = $this->whenFinderIsInvoked($course->id(), $course);
        $this->thenTheCourseShouldBeTheExpected($course, $actual);
    }

    public function testCourseFinderShouldThrowExceptionWhenCourseNotFound()
    {
        $course = $this->givenACourse();
        $this->whenFinderIsInvokedThenShouldThrowCourseNotFoundException($course->id());
    }
    
    private function givenACourse(): Course
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

    private function whenFinderIsInvokedThenShouldThrowCourseNotFoundException(CourseId $courseId)
    {
        $this->expectException(CourseNotExist::class);
        $this->searchShouldThrowException($courseId, new CourseNotExist($courseId));
        $this->courseFinder->__invoke($courseId);
    }
}
