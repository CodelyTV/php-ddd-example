<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Shared\Domain;

use CodelyTv\Tests\Shared\Domain\MotherCreator;

final class RandomElementPicker
{
    public static function from(...$elements)
    {
        return MotherCreator::random()->randomElement($elements);
    }
}
