<?php

namespace CodelyTv\Test\Infrastructure\Behat;

use Behat\Behat\Context\Context;
use CodelyTv\Infrastructure\Doctrine\DatabaseConnections;

class ApiFeatureContext implements Context
{
    private $connections;

    public function __construct(DatabaseConnections $connections)
    {
        $this->connections = $connections;
    }

    /** @BeforeScenario */
    public function cleanEnvironment()
    {
        $this->connections->clear();
        $this->connections->truncate();
    }
}
