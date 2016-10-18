<?php

namespace CodelyTv\Infrastructure\Bus;

final class MultipleHandleLocator
{
    private $handlers = [];

    public function add($key, callable $handler)
    {
        $this->handlers[$key][] = $handler;
    }

    public function find($key) : array
    {
        return $this->handlers[$key];
    }
}
