<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Student\Application\Find;

use CodelyTv\Mooc\Student\Application\Find\FindStudentQueryHandler;
use CodelyTv\Mooc\Student\Application\Find\StudentFinder;
use CodelyTv\Mooc\Student\Domain\StudentNotExist;
use CodelyTv\Test\Mooc\Student\Domain\StudentIdMother;
use CodelyTv\Test\Mooc\Student\Domain\StudentMother;
use CodelyTv\Test\Mooc\Student\Domain\StudentResponseMother;
use CodelyTv\Test\Mooc\Student\StudentModuleUnitTestCase;

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

        $id   = StudentIdMother::create($query->id());
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
