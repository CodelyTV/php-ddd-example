<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\Criteria\FilterField;
use CodelyTv\Test\Shared\Domain\WordMother;

final class FilterFieldMother
{
    public static function create($fieldName)
    {
        return new FilterField($fieldName);
    }

    public static function random()
    {
        return self::create(WordMother::random());
    }
}
