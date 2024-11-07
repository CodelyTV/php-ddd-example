<?php

declare(strict_types=1);

namespace CodelyTV\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;

final class CourseFinderTest extends CoursesModuleUnitTestCase
{
    private $finder;

    /** @test */
    public function it_should_find_an_existing_course(): void
    {
        $course       = $this->givenARandomCourse();       
        $actualCourse = $this->whenWeFindACourse($course);
        $this->thenTheResponseShouldBeTheExpected($course, $actualCourse);       
    }

    private function givenARandomCourse(): Course
    {
        return CourseMother::random();
    }

    private function whenWeFindACourse(Course $course): Course
    {
        $this->shouldSearch($course->id(), $course);

        $finder = new CourseFinder($this->repository());

        return $finder->__invoke($course->id());
    }

    private function thenTheResponseShouldBeTheExpected(Course $course, Course $actualCourse): void
    {
        $this->assertEquals($course, $actualCourse);
    }
}
