<?php

namespace CodelyTv\Mooc\Shared\Infrastructure\Clock;

use CodelyTv\Mooc\Shared\Domain\Clock\ClockInterface;
use Datetime;

final class ClockNow implements ClockInterface
{
    public function getDate(): Datetime
    {
        return new DateTime('now');
    }
}