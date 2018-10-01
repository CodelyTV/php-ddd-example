<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\Criteria\OrderBy;
use CodelyTv\Test\Shared\Domain\WordStub;

final class OrderByStub
{
    public static function create($fieldName)
    {
        return new OrderBy($fieldName);
    }

    public static function random()
    {
        return self::create(WordStub::random());
    }
}
