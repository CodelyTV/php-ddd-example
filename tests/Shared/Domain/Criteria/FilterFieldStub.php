<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\Criteria\FilterField;
use CodelyTv\Test\Shared\Domain\WordStub;

final class FilterFieldStub
{
    public static function create($fieldName)
    {
        return new FilterField($fieldName);
    }

    public static function random()
    {
        return self::create(WordStub::random());
    }
}
