<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Shared\Infrastructure\Mockery;

use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\Constraint\CodelyTvConstraintIsSimilar;
use Mockery\Matcher\MatcherAbstract;

final class CodelyTvMatcherIsSimilar extends MatcherAbstract
{
    private $constraint;

    public function __construct($value, $delta = 0.0)
    {
        parent::__construct($value);

        $this->constraint = new CodelyTvConstraintIsSimilar($value, $delta);
    }

    public function match(&$actual): bool
    {
        return $this->constraint->evaluate($actual, '', true);
    }

    public function __toString(): string
    {
        return 'Is similar';
    }
}
