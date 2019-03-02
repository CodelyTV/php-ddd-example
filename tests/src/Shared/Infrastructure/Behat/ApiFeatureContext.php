<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Behat;

use Behat\Behat\Context\Context;
use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Infrastructure\Bus\Event\SymfonySyncDomainEventPublisher;
use CodelyTv\Shared\Infrastructure\Bus\Event\SymfonySyncEventBus;
use CodelyTv\Shared\Infrastructure\Doctrine\DatabaseConnections;
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
    public function cleanEnvironment(): void
    {
        $this->connections->clear();
        $this->connections->truncate();
    }

    /** @AfterStep */
    public function publishEvents(): void
    {
        $publisher = function (DomainEvent $event) {
            $this->bus->notify($event);
        };

        while ($this->publisher->hasEventsToPublish()) {
            each($publisher, $this->publisher->popPublishedEvents());
        }
    }
}
