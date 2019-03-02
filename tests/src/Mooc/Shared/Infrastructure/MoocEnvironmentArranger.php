<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Shared\Infrastructure;

use CodelyTv\Shared\Infrastructure\Doctrine\DatabaseCleaner;
use CodelyTv\Test\Shared\Infrastructure\Arranger\EnvironmentArranger;
use Doctrine\ORM\EntityManager;
use function Lambdish\Phunctional\apply;

final class MoocEnvironmentArranger implements EnvironmentArranger
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function arrange(): void
    {
        apply(new DatabaseCleaner(), [$this->entityManager]);
    }

    public function close(): void
    {
    }
}
