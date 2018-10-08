<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain\Criteria;


use CodelyTv\Shared\Domain\Criteria\Filter;
use CodelyTv\Shared\Domain\Criteria\Filters;

final class FiltersStub
{
    /** @param Filter[] $filters */
    public static function create(array $filters)
    {
        return new Filters($filters);
    }

    public static function createOne(Filter $filter)
    {
        return self::create([$filter]);
    }

    public static function blank()
    {
        return self::create([]);
    }

    public static function random()
    {
        return self::create([FilterStub::random()]);
    }
}
