<?php

namespace CodelyTv\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManager;
use function Lambdish\Phunctional\each;

final class DatabaseConnections
{
    private $connections = [];

    public function set(string $name, EntityManager $entityManager)
    {
        $this->connections[$name] = $entityManager;
    }

    public function clearAll()
    {
        each($this->clear(), $this->connections);
    }

    private function clear()
    {
        return function (EntityManager $entityManager) {
            $entityManager->clear();
        };
    }
}
