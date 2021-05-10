<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;


use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;

class CourseFinderTest extends CoursesModuleUnitTestCase
{
    private CourseFinder|null $finder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->finder = new CourseFinder($this->repository());
    }

    /** @test */
    public function it_should_throw_an_exception_when_the_course_not_exist(): void
    {
        $this->expectException(CourseNotExist::class);

        $id = CourseIdMother::create();

        $this->shouldSearch($id, null);

        $this->finder->__invoke($id);
    }

    /** @test */
    public function it_should_find_an_existing_courses(): void
    {
        $course = CourseMother::create();

        $this->shouldSearch($course->id(), $course);

        $courseFromRepository = $this->finder->__invoke($course->id());

        $this->assertEquals($courseFromRepository, $course);
    }
}