<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Bus\Event\WithMonitoring;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Shared\Infrastructure\Monitoring\PrometheusMonitor;
use function Lambdish\Phunctional\each;

final class WithPrometheusMonitoringEventBus implements EventBus
{
    private PrometheusMonitor $monitor;
    private string            $appName;
    private EventBus          $bus;

    public function __construct(PrometheusMonitor $monitor, string $appName, EventBus $bus)
    {
        $this->monitor = $monitor;
        $this->appName = $appName;
        $this->bus     = $bus;
    }

    public function publish(DomainEvent ...$events): void
    {
        $counter = $this->monitor->registry()->getOrRegisterCounter(
            $this->appName,
            'domain_event',
            'Domain Events',
            ['name']
        );

        each(fn(DomainEvent $event) => $counter->inc(['name' => $event::eventName()]), $events);

        $this->bus->publish(...$events);
    }
}
