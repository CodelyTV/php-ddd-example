<?php

namespace CodelyTv\Infrastructure\Bus\Event;

final class SubscribersMapping
{
    private static $mapping = [];

    public function add(string $name, string $subscriberClass)
    {
        self::$mapping[$name] = $subscriberClass;
    }

    public function for(string $name) : string
    {
        return self::$mapping[$name];
    }

    public function all() : array
    {
        return self::$mapping;
    }
}
