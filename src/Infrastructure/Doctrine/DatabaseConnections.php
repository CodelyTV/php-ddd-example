<?php

namespace CodelyTv\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManager;
use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\each;

final class DatabaseConnections
{
    private $connections = [];

    public function set(string $name, EntityManager $entityManager)
    {
        $this->connections[$name] = $entityManager;
    }

    public function clear()
    {
        each($this->clearer(), $this->connections);
    }

    public function allConnectionsClearer()
    {
        return function () {
            $this->clear();
        };
    }

    public function truncate()
    {
        apply(new DatabaseCleaner(), array_values($this->connections));
    }

    public function testConnections()
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
