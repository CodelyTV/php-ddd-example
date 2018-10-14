<?php

namespace CodelyTv\Infrastructure\Bus\Event;

use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\search;

final class DomainEventSubscribersConfiguration
{
    private static $config = [];

    public function set(string $subscriber, array $config)
    {
        self::$config[$subscriber] = $config;
    }

    public function get(string $subscriber) : DomainEventSubscriberConfig
    {
        return new DomainEventSubscriberConfig(self::$config[$subscriber]);
    }

    public function byName($name) : DomainEventSubscriberConfig
    {
        return new DomainEventSubscriberConfig(search($this->byNameFinder($name), self::$config));
    }

    /** @return DomainEventSubscriberConfig[] */
    public function all() : array
    {
        return map($this->domainEventConfigCreator(), self::$config);
    }

    /** @return DomainEventSubscriberConfig[] */
    public function allWithEvent(string $name) : array
    {
        return map($this->domainEventConfigCreator(), filter($this->containingEvent($name), self::$config));
    }

    private function domainEventConfigCreator()
    {
        return function (array $configuration) {
            return new DomainEventSubscriberConfig($configuration);
        };
    }

    private function byNameFinder(string $name)
    {
        return function (array $config) use ($name) {
            return $name === $config['name'];
        };
    }

    private function containingEvent(string $name)
    {
        return function (array $config) use ($name) {
            return in_array($name, $config['subscribed_events']);
        };
    }
}
