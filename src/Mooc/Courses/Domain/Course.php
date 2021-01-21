<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class Course extends AggregateRoot implements \JsonSerializable
{
    public function __construct(
        private CourseId $id,
        private CourseName $name,
        private CourseDuration $duration,
        private CourseCreatedAt $createdAt
    ) {
    }

    public static function create(
        CourseId $id,
        CourseName $name,
        CourseDuration $duration,
    ): self {
        $course = new self($id, $name, $duration, new CourseCreatedAt(new \DateTimeImmutable('now')));

        $course->record(
            new CourseCreatedDomainEvent(
                $id->value(),
                $name->value(),
                $duration->value(),
                $course->createdAt()->value(),
            )
        );

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

    public function createdAt(): CourseCreatedAt
    {
        return $this->createdAt;
    }

    public function rename(CourseName $newName): void
    {
        $this->name = $newName;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'duration'   => $this->duration,
            'created_at' => $this->createdAt,
        ];
    }
}
