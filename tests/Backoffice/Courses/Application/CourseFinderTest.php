<?php

namespace CodelyTv\Tests\Backoffice\Courses\Application;

use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

class CourseFinderTest extends UnitTestCase
{
    /**
     * @test
     */
    public function given_a_course_finder_when_we_try_to_find_a_existent_course_then_we_got_that_course_succesfully()
    {
        // given
        $courseId = CourseId::random();
        $course = CourseMother::create($courseId);
        $courseFinder = $this->given_a_course_finder_which_finds_a_course_successfully($courseId, $course);

        // when
        $gotCourse = $courseFinder($courseId);

        // then
        self::assertSame($course, $gotCourse);
    }

    private function given_a_course_finder_which_finds_a_course_successfully(CourseId $courseId, Course $course): CourseFinder
    {
        $respository = $this->createMock(CourseRepository::class);
        $respository
            ->expects($this->once())
            ->method('search')
            ->with($courseId)
            ->willReturn($course);
        return new CourseFinder($respository);
    }

    /**
     * @test
     */
    public function given_a_course_finder_when_we_try_to_find_a_non_existent_course_then_an_exception_is_thrown()
    {
        // then
        $this->expectException(CourseNotExist::class);

        // given
        $courseId = CourseId::random();
        $courseFinder = $this->given_a_course_finder_which_do_not_find_a_course($courseId);

        // when
        $courseFinder($courseId);
    }

    private function given_a_course_finder_which_do_not_find_a_course(CourseId $courseId): CourseFinder
    {
        $respository = $this->createMock(CourseRepository::class);
        $respository
            ->expects($this->once())
            ->method('search')
            ->with($courseId)
            ->willReturn(null);
        return new CourseFinder($respository);
    }
}