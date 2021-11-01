<?php

namespace CodelyTv\Mooc\Shared\Infrastructure\Clock;

use CodelyTv\Mooc\Shared\Domain\Clock\ClockInterface;

use Datetime;

class CustomClock implements ClockInterface
{
    private Datetime $datetime;

    public function __construct(Datetime $datetime)
    {
        $this->datetime = $datetime;
    }
    public function getDate(): Datetime
    {
        return $this->datetime;
    }
}