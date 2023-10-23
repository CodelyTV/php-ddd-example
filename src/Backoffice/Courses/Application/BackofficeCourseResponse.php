<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Application;

final readonly class BackofficeCourseResponse
{
	public function __construct(private string $id, private string $name, private string $duration) {}

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
