<?php

namespace CodelyTv\Infrastructure\Bus\Event;

final class DomainEventMapping
{
    private static $mapping = [];

    public function add(string $name, string $eventClass)
    {
        self::$mapping[$name] = $eventClass;
    }

    public function for(string $name)
    {
        return self::$mapping[$name];
    }

    public function all()
    {
        return self::$mapping;
    }
}
