<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;

final class CourseFinderTest extends CoursesModuleUnitTestCase
{
    /**
     * @var CourseFinder
     */
    private $finder;

    /**
     * @var Course
     */
    private $course;

    /**
     * @var Course|null
     */
    private $actualResult;

    public function testFindCourse()
    {
        $this->givenSubjectUnderTest();
        $this->givenAnExistingCourse();
        $this->shouldSearch($this->course->id(), $this->course);

        $this->whenISearchForTheExistingCourse();

        $this->thenTheCourseIsReturned();
    }

    public function testFindCourseNotFound()
    {
        $this->givenSubjectUnderTest();
        $this->givenAnExistingCourse();
        $this->shouldSearch($this->course->id(), CourseMother::nullCourse());

        $this->thenCourseNotExistShouldBeThrown();

        $this->whenISearchForTheExistingCourse();
    }

    private function thenTheCourseIsReturned()
    {
        $this->assertEquals($this->actualResult, $this->course);
    }

    private function thenCourseNotExistShouldBeThrown()
    {
        $this->expectException(CourseNotExist::class);
    }

    private function whenISearchForTheExistingCourse()
    {
        $this->actualResult = $this->finder->__invoke($this->course->id());
    }

    private function givenAnExistingCourse()
    {
        $this->course = CourseMother::random();
    }

    private function givenSubjectUnderTest()
    {
        $this->finder = new CourseFinder($this->repository());
    }
}