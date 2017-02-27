<?php

namespace CodelyTv\Shared\Domain;

final class SecondsInterval
{
    private $from;
    private $to;

    public function __construct(Second $from, Second $to)
    {
        $this->guard($from, $to);

        $this->from = $from;
        $this->to   = $to;
    }

    public function from(): Second
    {
        return $this->from;
    }

    public function to(): Second
    {
        return $this->to;
    }

    public static function fromValues(int $from, int $to)
    {
        return new self(new Second($from), new Second($to));
    }

    private function guard(Second $from, Second $to)
    {
        if ($from->equalsTo($to) || $from->isBiggerThan($to)) {
        }
    }
}
