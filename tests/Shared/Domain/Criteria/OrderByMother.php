<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\Criteria\OrderBy;
use CodelyTv\Test\Shared\Domain\WordMother;

final class OrderByMother
{
    public static function create($fieldName)
    {
        return new OrderBy($fieldName);
    }

    public static function random()
    {
        return self::create(WordMother::random());
    }
}
