<?php

namespace CodelyTv\Infrastructure\Bus;

final class HandleLocator
{
    private $handlers = [];

    public function add($key, callable $handler)
    {
        $this->handlers[$key] = $handler;
    }

    public function find($key)
    {
        return $this->handlers[$key];
    }
}
