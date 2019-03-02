<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Student\Infrastructure\Persistence;

use CodelyTv\Mooc\Student\Domain\StudentRepository;
use CodelyTv\Test\Mooc\Student\Domain\StudentIdMother;
use CodelyTv\Test\Mooc\Student\Domain\StudentMother;
use CodelyTv\Test\Mooc\Student\Domain\StudentsMother;
use CodelyTv\Test\Mooc\Student\StudentModuleFunctionalTestCase;

final class StudentRepositoryTest extends StudentModuleFunctionalTestCase
{
    /** @test */
    public function it_should_save_a_video(): void
    {
        $this->repository()->save(StudentMother::random());
    }

    /** @test */
    public function it_should_find_an_existing_video(): void
    {
        $student = StudentMother::random();

        $this->repository()->save($student);
        $this->clearUnitOfWork();

        $this->assertSimilar($student, $this->repository()->search($student->id()));
    }

    /** @test */
    public function it_should_find_multiples_video(): void
    {
        $student  = StudentMother::random();
        $another  = StudentMother::random();
        $students = StudentsMother::create($student, $another);

        $this->repository()->saveAll($students);
        $this->clearUnitOfWork();

        $this->assertSimilar($students, $this->repository()->all());
    }

    /** @test */
    public function it_should_not_find_a_non_existing_video(): void
    {
        $this->assertNull($this->repository()->search(StudentIdMother::random()));
    }

    private function repository(): StudentRepository
    {
        return $this->service('codely.mooc.student.repository');
    }
}
