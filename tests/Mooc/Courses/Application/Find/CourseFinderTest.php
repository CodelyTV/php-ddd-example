<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;


use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\CourseNotExist;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use Ramsey\Uuid\Uuid;

final class CourseFinderTest extends CoursesModuleUnitTestCase
{


    /** @test */
    public function it_should_find_an_existing_course(): void
    {
        $course = CourseMother::Create();
        $finder = new CourseFinder($this->repository());

        $this->shouldSearch($course->id(), $course);
        $courseFound = $finder->__invoke($course->id());

        $this->assertSimilar($course, $courseFound);
    }

    /** @test */
    public function it_should_course_not_exist(): void
    {
        $this->expectException(CourseNotExist::class);

        $finder = new CourseFinder($this->repository());

        $courseId = CourseIdMother::Create();

        $this->shouldSearch($courseId, null);

        $finder->__invoke($courseId);
    }
}