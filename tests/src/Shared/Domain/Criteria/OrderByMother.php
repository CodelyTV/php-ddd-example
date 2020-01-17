<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\Criteria\OrderBy;
use CodelyTv\Tests\Shared\Domain\WordMother;

final class OrderByMother
{
    public static function create($fieldName): OrderBy
    {
        return new OrderBy($fieldName);
    }

    public static function random(): OrderBy
    {
        return self::create(WordMother::random());
    }
}
