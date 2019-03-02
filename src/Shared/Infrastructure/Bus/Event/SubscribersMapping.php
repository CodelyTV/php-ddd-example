<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Bus\Event;

final class SubscribersMapping
{
    private static $mapping = [];

    public function add(string $name, callable $subscriberClass): void
    {
        self::$mapping[$name] = $subscriberClass;
    }

    public function byName(string $name): callable
    {
        return self::$mapping[$name];
    }

    public function all(): array
    {
        return self::$mapping;
    }
}
