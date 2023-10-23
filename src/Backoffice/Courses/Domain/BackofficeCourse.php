<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Domain;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class BackofficeCourse extends AggregateRoot
{
	public function __construct(private readonly string $id, private readonly string $name, private readonly string $duration) {}

	public static function fromPrimitives(array $primitives): self
	{
		return new self($primitives['id'], $primitives['name'], $primitives['duration']);
	}

	public function toPrimitives(): array
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'duration' => $this->duration,
		];
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
