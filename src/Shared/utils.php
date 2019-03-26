<?php

declare(strict_types = 1);

namespace CodelyTv\Utils\Shared;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use function Lambdish\Phunctional\filter_null;
use function Lambdish\Phunctional\map;

function date_to_string(DateTimeInterface $date): string
{
    return $date->format(DateTime::ATOM);
}

function string_to_date(string $date): DateTimeImmutable
{
    return new DateTimeImmutable($date);
}

function snake_to_camel($word)
{
    return lcfirst(str_replace('_', '', ucwords($word, '_')));
}

function camel_to_snake($word)
{
    return ctype_lower($word) ? $word : strtolower(preg_replace('/([^A-Z\s])([A-Z])/', '$1_$2', $word));
}

function map_no_null(callable $fn, $coll)
{
    return filter_null(map($fn, $coll));
}
