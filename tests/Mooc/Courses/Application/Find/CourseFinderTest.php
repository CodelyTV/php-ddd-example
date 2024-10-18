<?php

declare(strict_types=1);

namespace CodelyTV\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;

final class CourseFinderTest extends CoursesModuleUnitTestCase
{
    private $finder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->finder = new CourseFinder($this->repository());
    }

    /** @test */
    public function it_should_return_an_existing_course(): void
    {
        $course = CourseMother::create();

        $this->shouldSearch($course->id(), $course);        
        $foundCourse = $this->finder->__invoke($course->id());   
        
        $this->assertEquals($course, $foundCourse); 
    }

    /** @test */
    public function it_should_throw_an_exception_when_the_course_not_exists(): void
    {
        $courseId = CourseIdMother::create();

        $this->expectException(CourseNotExist::class);
        $this->shouldSearch($courseId, null);
        $this->finder->__invoke($courseId);
    }
}