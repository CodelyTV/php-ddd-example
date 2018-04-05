<?php

namespace CodelyTv\Test\Infrastructure\Mockery;

use CodelyTv\Test\Infrastructure\PHPUnit\Constraint\CodelyTvConstraintIsSimilar;
use Mockery\Matcher\MatcherAbstract;

final class CodelyTvMatcherIsSimilar extends MatcherAbstract
{
    private $constraint;

    public function __construct($value, $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
    {
        parent::__construct($value);

        $this->constraint = new CodelyTvConstraintIsSimilar(
            $value,
            $delta,
            $maxDepth,
            $canonicalize,
            $ignoreCase
        );
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
        return 'Is similar';
    }
}
