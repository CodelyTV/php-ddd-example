<?php

namespace CodelyTv\Test\Behat;

use Behat\Behat\Context\Context;
use CodelyTv\Infrastructure\Doctrine\DatabaseConnections;

abstract class ApplicationFeatureContext implements Context
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
