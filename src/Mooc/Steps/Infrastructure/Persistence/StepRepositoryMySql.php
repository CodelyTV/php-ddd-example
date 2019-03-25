<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Infrastructure\Persistence;

use CodelyTv\Mooc\Steps\Domain\Step;
use CodelyTv\Mooc\Steps\Domain\StepRepository;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineRepository;

final class StepRepositoryMySql extends DoctrineRepository implements StepRepository
{
    public function save(Step $step): void
    {
        $this->persist($step);
    }
}
