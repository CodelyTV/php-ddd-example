<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Steps\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateVideoStepCommandHandler implements CommandHandler
{
	public function __construct(private VideoStepCreator $creator) {}

	public function __invoke(): void {}
}
