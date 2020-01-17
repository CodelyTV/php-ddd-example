<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Courses\Domain;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class BackofficeCourse extends AggregateRoot
{
    private $id;
    private $name;
    private $duration;

    public function __construct(string $id, string $name, string $duration)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->duration = $duration;
    }

    public function toPrimitives(): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'duration' => $this->duration,
        ];
    }

    public static function fromPrimitives(array $primitives): BackofficeCourse
    {
        return new self($primitives['id'], $primitives['name'], $primitives['duration']);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function duration(): string
    {
        return $this->duration;
    }
}
