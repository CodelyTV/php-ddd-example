<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Mockery;

use CodelyTv\Test\Shared\Infrastructure\PHPUnit\Constraint\CodelyTvConstraintIsEqual;
use Mockery\Matcher\MatcherAbstract;

final class CodelyTvMatcherIsEqual extends MatcherAbstract
{
    private $constraint;

    public function __construct($value, $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
    {
        parent::__construct($value);

        $this->constraint = new CodelyTvConstraintIsEqual($value, $delta, $maxDepth, $canonicalize, $ignoreCase);
    }

    public static function equalTo($value, $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
    {
        return new static($value, $delta, $maxDepth, $canonicalize, $ignoreCase);
    }

    public function match(&$actual)
    {
        return $this->constraint->evaluate($actual, '', true);
    }

    public function __toString()
    {
        return 'Is equal';
    }
}
