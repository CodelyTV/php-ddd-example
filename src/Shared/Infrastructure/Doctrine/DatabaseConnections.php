<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManager;
use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\each;

final class DatabaseConnections
{
    private $connections = [];

    public function set(string $name, EntityManager $entityManager): void
    {
        $this->connections[$name] = $entityManager;
    }

    public function clear(): void
    {
        each($this->clearer(), $this->connections);
    }

    public function allConnectionsClearer(): callable
    {
        return function (): void {
            $this->clear();
        };
    }

    public function truncate(): void
    {
        apply(new DatabaseCleaner(), array_values($this->connections));
    }

    public function testConnections(): void
    {
        each($this->connectionTester(), $this->connections);
    }

    private function clearer(): callable
    {
        return function (EntityManager $entityManager) {
            $entityManager->clear();
        };
    }

    private function connectionTester(): callable
    {
        return function (EntityManager $entityManager) {
            $entityManager->getConnection()->connect();
        };
    }
}
