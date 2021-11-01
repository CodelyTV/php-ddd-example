<?php

namespace CodelyTv\Mooc\Shared\Domain\Clock;

abstract class Season
{
    public abstract function start(): ClockInterface;
    public abstract function ends(): ClockInterface;

    protected static function getYear()
    {
        return (new Datetime('now'))->format('Y');
    }

    public function isDateInSeason(ClockInterface $date): bool
    {
        return $date->getDate() >= $this->start()->getDate() && $date->getDate() <= $this->ends()->getDate();
    }
}