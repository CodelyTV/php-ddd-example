<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Steps\Domain;

use CodelyTv\Mooc\Steps\Domain\StepEstimatedDuration;
use CodelyTv\Test\Shared\Domain\NumberMother;

final class StepEstimatedDurationMother
{
    public static function create(int $value): StepEstimatedDuration
    {
        return new StepEstimatedDuration($value);
    }

    public static function random(): StepEstimatedDuration
    {
        return self::create(NumberMother::lessThan(1000));
    }
}
