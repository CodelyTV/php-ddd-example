<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Steps\Infrastructure\Persistence;

use CodelyTv\Mooc\Steps\Domain\Step;
use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Mooc\Steps\Domain\StepRepository;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class MySqlStepRepository extends DoctrineRepository implements StepRepository
{
	public function save(Step $step): void
	{
		$this->persist($step);
	}

	public function search(StepId $id): ?Step
	{
		return $this->repository(Step::class)->find($id);
	}

	public function delete(Step $step): void
	{
		$this->remove($step);
	}
}
