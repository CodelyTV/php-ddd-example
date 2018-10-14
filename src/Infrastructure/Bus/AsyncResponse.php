<?php

declare (strict_types = 1);

namespace CodelyTv\Infrastructure\Bus;

final class AsyncResponse
{
    private $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function values(): array
    {
        return $this->values;
    }
}
