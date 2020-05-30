<?php
declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Application\Find\AllCourseFinder;
use CodelyTv\Mooc\Courses\Application\Find\FindAllCoursesQuery;
use CodelyTv\Mooc\Courses\Application\Find\FindAllCoursesQueryHandler;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;
use CodelyTv\Tests\Mooc\CoursesCounter\Application\Find\FindAllCoursesResponseMother;

class FindAllCoursesQueryHandlerTest extends CoursesModuleUnitTestCase
{
    private FindAllCoursesQueryHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = new FindAllCoursesQueryHandler(new AllCourseFinder($this->repository()));
    }

    /** @test */
    public function it_should_find_all_courses(): void
    {
        $query    = new FindAllCoursesQuery();
        $courses  = [
            CourseMother::random(),
            CourseMother::random()
        ];
        $response = FindAllCoursesResponseMother::create($courses);

        $this->shouldFindAll($courses);

        $this->assertAskResponse($response, $query, $this->handler);
    }
}
