<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;


use CodelyTv\Mooc\Courses\Application\Find\AllCoursesFinder;
use CodelyTv\Mooc\Courses\Application\Find\FindAllCoursesQuery;
use CodelyTv\Mooc\Courses\Application\Find\FindAllCoursesQueryHandler;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use CodelyTv\Tests\Mooc\Courses\Domain\CoursesResponseMother;

class FindAllCoursesQueryHandlerTest extends CoursesModuleUnitTestCase
{
    private FindAllCoursesQueryHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new FindAllCoursesQueryHandler(new AllCoursesFinder($this->repository()));
    }


    /** @test */
    public function it_should_find_all_existing_courses(): void
    {
        $courses = [
            CourseMother::create(),
            CourseMother::create()
        ];

        $this->shouldFindAll($courses);
        $coursesResponse      = CoursesResponseMother::create($courses);
        $courseFromRepository = $this->handler->__invoke(new FindAllCoursesQuery());

        $this->assertEquals($courseFromRepository, $coursesResponse);
    }
}
