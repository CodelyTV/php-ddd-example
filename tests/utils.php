<?php

declare(strict_types=1);

namespace CodelyTv\Test;

use CodelyTv\Test\Infrastructure\Mockery\CodelyTvMatcherIsEqual;
use CodelyTv\Test\Infrastructure\Mockery\CodelyTvMatcherIsSimilar;
use CodelyTv\Test\Infrastructure\PHPUnit\Constraint\CodelyTvConstraintIsEqual;
use CodelyTv\Test\Infrastructure\PHPUnit\Constraint\CodelyTvConstraintIsSimilar;
use PHPUnit\Framework\Assert;

function isSimilar($expected, $value, $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
{
    $constraint = new CodelyTvConstraintIsSimilar($expected, $delta, $maxDepth, $canonicalize, $ignoreCase);

    return $constraint->evaluate($value, '', true);
}

function assertSimilar(
    $expected,
    $actual,
    $message = '',
    $delta = 0.0,
    $maxDepth = 10,
    $canonicalize = false,
    $ignoreCase = false
) {
    $constraint = new CodelyTvConstraintIsSimilar($expected, $delta, $maxDepth, $canonicalize, $ignoreCase);

    Assert::assertThat($actual, $constraint, $message);
}

function similarTo($value, $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
{
    return CodelyTvMatcherIsSimilar::equalTo($value, $delta, $maxDepth, $canonicalize, $ignoreCase);
}

function isEqual($expected, $value, $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
{
    $constraint = new CodelyTvConstraintIsEqual($expected, $delta, $maxDepth, $canonicalize, $ignoreCase);

    return $constraint->evaluate($value, '', true);
}

function assertEquals(
    $expected,
    $actual,
    $message = '',
    $delta = 0.0,
    $maxDepth = 10,
    $canonicalize = false,
    $ignoreCase = false
) {
    $constraint = new CodelyTvConstraintIsEqual($expected, $delta, $maxDepth, $canonicalize, $ignoreCase);

    Assert::assertThat($actual, $constraint, $message);
}

function equalTo($value, $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
{
    return CodelyTvMatcherIsEqual::equalTo($value, $delta, $maxDepth, $canonicalize, $ignoreCase);
}
