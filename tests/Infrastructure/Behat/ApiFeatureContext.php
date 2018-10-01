<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Infrastructure\Behat;

use Behat\Behat\Context\Context;
use CodelyTv\Infrastructure\Bus\Event\SymfonySyncDomainEventPublisher;
use CodelyTv\Infrastructure\Bus\Event\SymfonySyncEventBus;
use CodelyTv\Infrastructure\Doctrine\DatabaseConnections;
use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use function Lambdish\Phunctional\each;

final class ApiFeatureContext implements Context
{
    private $connections;
    private $publisher;
    private $bus;

    public function __construct(
        DatabaseConnections $connections,
        SymfonySyncDomainEventPublisher $publisher,
        SymfonySyncEventBus $bus
    ) {
        $this->connections = $connections;
        $this->publisher   = $publisher;
        $this->bus         = $bus;
    }

    /** @BeforeScenario */
    public function cleanEnvironment()
    {
        $this->connections->clear();
        $this->connections->truncate();
    }


    /** @AfterStep */
    public function publishEvents()
    {
        $publisher = function (DomainEvent $event) {
            $this->bus->notify($event);
        };

        while ($this->publisher->hasEventsToPublish()) {
            each($publisher, $this->publisher->popPublishedEvents());
        }
    }
}
