<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Bus;

final class MultipleHandleLocator
{
    private $handlers = [];

    public function add($key, callable $handler): void
    {
        $this->handlers[$key][] = $handler;
    }

    public function find($key): array
    {
        return $this->handlers[$key];
    }
}
