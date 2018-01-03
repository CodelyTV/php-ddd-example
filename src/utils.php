<?php

namespace CodelyTv\Utils;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use function Lambdish\Phunctional\filter_null;
use function Lambdish\Phunctional\map;

function date_to_string(DateTimeInterface $date): string
{
    $timestamp             = $date->getTimestamp();
    $microseconds          = $date->format('u');
    $millisecondsOnASecond = 1000;

    return (string) (((float) ((string) $timestamp . '.' . (string) $microseconds)) * $millisecondsOnASecond);
}

function string_to_date($milliseconds): DateTimeImmutable
{
    $millisecondsOnASecond = 1000;
    $asSeconds             = (int) floor($milliseconds / $millisecondsOnASecond);
    $dateTime              = new DateTimeImmutable('@' . ((string) $asSeconds), new DateTimeZone('UTC'));

    return new DateTimeImmutable(
        $dateTime->format('Y-m-d\TH:i:s') .
        '.' .
        sprintf('%03d', $milliseconds % $millisecondsOnASecond) .
        '000' .
        $dateTime->format('O')
    );
}

function snake_to_camel($word)
{
    return lcfirst(str_replace('_', '', ucwords($word, '_')));
}

function camel_to_snake($word)
{
    return ctype_lower($word) ? $word : strtolower(preg_replace('/([^A-Z\s])([A-Z])/', "$1_$2", $word));
}

function map_no_null(callable $fn, $coll)
{
    return filter_null(map($fn, $coll));
}
