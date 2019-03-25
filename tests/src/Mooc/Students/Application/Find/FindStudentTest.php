<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Students\Application\Find;

use CodelyTv\Mooc\Students\Application\Find\FindStudentQueryHandler;
use CodelyTv\Mooc\Students\Application\Find\StudentFinder;
use CodelyTv\Mooc\Students\Domain\StudentNotExist;
use CodelyTv\Test\Mooc\Students\Domain\StudentIdMother;
use CodelyTv\Test\Mooc\Students\Domain\StudentMother;
use CodelyTv\Test\Mooc\Students\Domain\StudentResponseMother;
use CodelyTv\Test\Mooc\Students\StudentModuleUnitTestCase;

final class FindStudentTest extends StudentModuleUnitTestCase
{
    /** @var FindStudentQueryHandler */
    private $handler;

    protected function setUp()
    {
        parent::setUp();

        $finder = new StudentFinder($this->repository());

        $this->handler = new FindStudentQueryHandler($finder);
    }

    /** @test */
    public function it_should_find_an_existing_student(): void
    {
        $query = FindStudentQueryMother::random();

        $id      = StudentIdMother::create($query->id());
        $student = StudentMother::withId($id);

        $response = StudentResponseMother::create($student->id(), $student->name(), $student->totalVideosCreated());

        $this->shouldSearchStudent($id, $student);

        $this->assertAskResponse($query, $response, $this->handler);
    }

    /** @test */
    public function it_should_throw_an_exception_finding_a_non_existing_student(): void
    {
        $query = FindStudentQueryMother::random();

        $id = StudentIdMother::create($query->id());

        $this->shouldSearchStudent($id);

        $this->assertAskThrowsException(StudentNotExist::class, $query, $this->handler);
    }
}
