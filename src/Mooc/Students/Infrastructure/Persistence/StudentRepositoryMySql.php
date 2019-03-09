<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Students\Infrastructure\Persistence;

use CodelyTv\Mooc\Students\Domain\Student;
use CodelyTv\Mooc\Students\Domain\StudentId;
use CodelyTv\Mooc\Students\Domain\StudentRepository;
use CodelyTv\Mooc\Students\Domain\Students;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineRepository;
use function Lambdish\Phunctional\each;

final class StudentRepositoryMySql extends DoctrineRepository implements StudentRepository
{
    public function save(Student $student): void
    {
        $this->persist($student);
    }

    public function saveAll(Students $students): void
    {
        each($this->persister(), $students);
    }

    public function search(StudentId $id): ?Student
    {
        return $this->repository(Student::class)->find($id);
    }

    public function all(): Students
    {
        return new Students($this->repository(Student::class)->findAll());
    }
}
