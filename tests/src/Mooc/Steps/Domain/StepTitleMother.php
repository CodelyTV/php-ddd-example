<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Steps\Domain;

use CodelyTv\Mooc\Steps\Domain\StepTitle;
use CodelyTv\Test\Shared\Domain\TextMother;

final class StepTitleMother
{
    public static function create(string $value): StepTitle
    {
        return new StepTitle($value);
    }

    public static function random(): StepTitle
    {
        return self::create(TextMother::short());
    }
}
