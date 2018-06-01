<?php

namespace CodelyTv\Infrastructure\Bus\Event;

final class DomainEventSubscriberConfig
{
    private static $defaultConfig = [
        'processes'         => 1,
        'priority'          => 0,
        'events_to_process' => 200,
        'enabled'           => true,
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

    public function processes()
    {
        return $this->config['processes'];
    }

    public function priority()
    {
        return $this->config['priority'];
    }

    public function eventsToProcess()
    {
        return $this->config['events_to_process'];
    }

    public function subscribedEvents(): array
    {
        return $this->config['subscribed_events'];
    }

    public function isSubscribedToEvent($eventName)
    {
        return in_array($eventName, $this->subscribedEvents());
    }

    public function isEnabled(): bool
    {
        return $this->config['enabled'];
    }

    public function enabledString()
    {
        return $this->isEnabled() ? 'true' : 'false';
    }

    public static function blank()
    {
        return new self([]);
    }
}
