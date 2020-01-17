<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Mooc\Shared\Infrastructure\PhpUnit;

use CodelyTv\Tests\Shared\Infrastructure\Arranger\EnvironmentArranger;
use CodelyTv\Tests\Shared\Infrastructure\Doctrine\DatabaseCleaner;
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
