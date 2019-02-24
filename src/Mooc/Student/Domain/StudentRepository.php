<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Student\Domain;

interface StudentRepository
{
    public function save(Student $student): void;

    public function saveAll(Students $students): void;

    public function search(StudentId $id): ?Student;

    public function all(): Students;
}
