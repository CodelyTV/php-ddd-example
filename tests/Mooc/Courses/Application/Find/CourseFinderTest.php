<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;

final class CourseFinderTest extends CoursesModuleUnitTestCase
{
    private CourseFinder $finder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->finder = new CourseFinder($this->repository());
    }

    /** @test */
    public function it_should_find_a_course(): void
    {
        $course = CourseMother::create();

        $this->shouldSearch($course->id(), $course);

        $courseFound = $this->finder->__invoke($course->id());
        $this->assertSimilar($courseFound->id(), $course->id());
    }

    /** @test */
    public function it_should_return_an_exception_finding_an_inexsitent_course(): void
    {
        $course = CourseMother::create();
        
        $this->shouldSearch($course->id(), null);
        $this->expectException(CourseNotExist::class);
        $this->finder->__invoke($course->id());
    }
}
