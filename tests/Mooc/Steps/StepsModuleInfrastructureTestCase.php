<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Steps;

use CodelyTv\Mooc\Steps\Domain\StepRepository;
use CodelyTv\Tests\Mooc\Shared\Infrastructure\PhpUnit\MoocContextInfrastructureTestCase;

abstract class StepsModuleInfrastructureTestCase extends MoocContextInfrastructureTestCase
{
	protected function repository(): StepRepository
	{
		return $this->service(StepRepository::class);
	}
}
