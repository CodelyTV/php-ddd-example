<?php

namespace CodelyTv\Infrastructure\Bus\Event;

final class DomainEventSubscriberConfig
{
    private static $defaultConfig = [
        'processes' => 1,
        'priority'  => 0,
    ];
    private $config;

    public function __construct(array $config)
    {
        $this->config = array_merge(self::$defaultConfig, $config);
    }

    public function name(): string
    {
        return $this->config['name'];
    }

    public function priority()
    {
        return $this->config['priority'];
    }

    public function subscribedEvents(): array
    {
        return $this->config['subscribed_events'];
    }

    public static function blank()
    {
        return new self([]);
    }
}
