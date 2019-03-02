<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\Criteria\FilterValue;
use CodelyTv\Test\Shared\Domain\WordMother;

final class FilterValueMother
{
    public static function create($value): FilterValue
    {
        return new FilterValue($value);
    }

    public static function random(): FilterValue
    {
        return self::create(WordMother::random());
    }
}
