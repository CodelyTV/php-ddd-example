<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Remove;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class RemoveVideoCommand extends Command
{
	private $id;

	public function __construct(Uuid $commandId, string $id)
	{
		parent::__construct($commandId);

		$this->id = $id;
	}

	public function id(): string
	{
		return $this->id;

	}

}