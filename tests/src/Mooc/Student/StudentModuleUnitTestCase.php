<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Student;

use CodelyTv\Mooc\Student\Domain\Student;
use CodelyTv\Mooc\Student\Domain\StudentRepository;
use CodelyTv\Mooc\Student\Domain\StudentId;
use CodelyTv\Test\Mooc\Shared\Infrastructure\MoocContextUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\equalTo;
use function CodelyTv\Test\similarTo;

abstract class StudentModuleUnitTestCase extends MoocContextUnitTestCase
{
    private $repository;

    /** @return StudentRepository|MockInterface */
    protected function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(StudentRepository::class);
    }

    protected function shouldSaveStudent(Student $student): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(similarTo($student))
            ->once()
            ->andReturnNull();
    }

    protected function shouldSearchStudent(StudentId $id, Student $student = null)
    {
        $this->repository()
            ->shouldReceive('search')
            ->with(equalTo($id))
            ->once()
            ->andReturn($student);
    }
}
