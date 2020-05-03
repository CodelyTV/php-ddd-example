<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class Course extends AggregateRoot
{
    private CourseId       $id;
    private CourseName     $name;
    private CourseDuration $duration;
    private CourseCreatedTime $createdAt;

    public function __construct(CourseId $id, CourseName $name, CourseDuration $duration, CourseCreatedTime $createdAt)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->duration = $duration;
        $this->createdAt = $createdAt;
    }

    public static function create(CourseId $id, CourseName $name, CourseDuration $duration): self
    {
        $createdAt = new CourseCreatedTime(new \DateTimeImmutable());
        $course = new self($id, $name, $duration, $createdAt);

        $course->record(new CourseCreatedDomainEvent($id->value(), $name->value(), $duration->value()));

        return $course;
    }

    public function id(): CourseId
    {
        return $this->id;
    }

    public function name(): CourseName
    {
        return $this->name;
    }

    public function duration(): CourseDuration
    {
        return $this->duration;
    }

    public function createdAt(): CourseCreatedTime
    {
        return $this->createdAt;
    }

    public function rename(CourseName $newName): void
    {
        $this->name = $newName;
    }
}
