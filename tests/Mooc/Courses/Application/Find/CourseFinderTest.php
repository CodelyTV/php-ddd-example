<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;

final class CourseFinderTest extends CoursesModuleUnitTestCase
{

    private CourseFinder $finder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->finder = new CourseFinder($this->repository());
    }

    /** @test */
    public function it_should_find_an_existing_course(): void
    {
        $course = CourseMother::create();

        $this->shouldSearch($course->id(), $course);
        $courseFound = $this->finder->__invoke($course->id());

        $this->assertEquals($course, $courseFound);
    }

    /** @test */
    public function it_should_throw_an_exception_when_the_course_not_exist(): void
    {
        $this->expectException(CourseNotExist::class);

        $id = CourseIdMother::create();
        $this->shouldSearch($id, null);
        $this->finder->__invoke($id);
    }
}