<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Monitoring;

use Prometheus\CollectorRegistry;
use Prometheus\Storage\APC;

final class PrometheusMonitor
{
    private readonly CollectorRegistry $registry;

    public function __construct()
    {
        $this->registry = new CollectorRegistry(new APC());
    }

    public function registry(): CollectorRegistry
    {
        return $this->registry;
    }
}
