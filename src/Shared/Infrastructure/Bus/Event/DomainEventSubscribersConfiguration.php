<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Bus\Event;

use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\search;

final class DomainEventSubscribersConfiguration
{
    private static $config = [];

    public function set(string $subscriber, array $config): void
    {
        self::$config[$subscriber] = $config;
    }

    public function get(string $subscriber): DomainEventSubscriberConfig
    {
        return new DomainEventSubscriberConfig(self::$config[$subscriber]);
    }

    public function byName($name): DomainEventSubscriberConfig
    {
        return new DomainEventSubscriberConfig(search($this->byNameFinder($name), self::$config));
    }

    /** @return DomainEventSubscriberConfig[] */
    public function all(): array
    {
        return map($this->domainEventConfigCreator(), self::$config);
    }

    /** @return DomainEventSubscriberConfig[] */
    public function allWithEvent(string $name): array
    {
        return map($this->domainEventConfigCreator(), filter($this->containingEvent($name), self::$config));
    }

    private function domainEventConfigCreator(): callable
    {
        return function (array $configuration): DomainEventSubscriberConfig {
            return new DomainEventSubscriberConfig($configuration);
        };
    }

    private function byNameFinder(string $name): callable
    {
        return function (array $config) use ($name): bool {
            return $name === $config['name'];
        };
    }

    private function containingEvent(string $name): callable
    {
        return function (array $config) use ($name): bool {
            return in_array($name, $config['subscribed_events'], false);
        };
    }
}
