<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Application;

use CodelyTv\Shared\Domain\Bus\Query\ResponseCollection;

final class StepsResponse extends ResponseCollection
{
    protected function type(): string
    {
        return StepResponse::class;
    }
}
