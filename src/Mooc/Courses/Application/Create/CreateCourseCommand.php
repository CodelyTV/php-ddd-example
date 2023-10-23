<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final readonly class CreateCourseCommand implements Command
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
