<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Steps\Application\Create;

use CodelyTv\Mooc\Steps\Domain\StepRepository;

final readonly class VideoStepCreator
{
	public function __construct(private StepRepository $repository) {}

	public function __invoke(): void {}
}
