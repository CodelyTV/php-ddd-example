<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Application\Find\LastCourseFinder;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;

final class LastCourseFinderTest extends CoursesModuleUnitTestCase
{
    private $finder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->finder = new LastCourseFinder($this->repository());
    }

    /** @test */
    public function it_should_find_latest_course(): void
    {
        $latestCourse = CourseMother::random();

        $this->shouldSearchLatest($latestCourse);

        $this->finder->__invoke();
    }
}
