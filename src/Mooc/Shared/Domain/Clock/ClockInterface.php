<?php

namespace CodelyTv\Mooc\Shared\Domain\Clock;

use Datetime;

interface ClockInterface
{
    public function getDate(): Datetime;
}