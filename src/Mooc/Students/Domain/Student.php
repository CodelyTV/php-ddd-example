<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Students\Domain;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class Student extends AggregateRoot
{
    private $id;
    private $name;
    private $totalVideosCreated;

    public function __construct(StudentId $id, StudentName $name, StudentTotalVideosCreated $totalVideosCreated)
    {
        $this->id                 = $id;
        $this->name               = $name;
        $this->totalVideosCreated = $totalVideosCreated;
    }

    public function id(): StudentId
    {
        return $this->id;
    }

    public function name(): StudentName
    {
        return $this->name;
    }

    public function totalVideosCreated(): StudentTotalVideosCreated
    {
        return $this->totalVideosCreated;
    }

    public function increaseTotalVideosCreated(): void
    {
        $this->totalVideosCreated = $this->totalVideosCreated->increase();
    }
}
