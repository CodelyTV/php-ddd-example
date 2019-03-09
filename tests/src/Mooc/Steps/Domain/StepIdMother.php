<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Steps\Domain;

use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class StepIdMother
{
    public static function create(string $id): StepId
    {
        return new StepId($id);
    }

    public static function random(): StepId
    {
        return self::create(UuidMother::random());
    }
}
