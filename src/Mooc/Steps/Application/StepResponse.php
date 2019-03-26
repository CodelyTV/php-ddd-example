<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Application;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class StepResponse implements Response
{
    private $id;
    private $estimatedDuration;

    public function __construct(string $id, int $estimatedDuration)
    {
        $this->id                = $id;
        $this->estimatedDuration = $estimatedDuration;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function estimatedDuration(): int
    {
        return $this->estimatedDuration;
    }
}
