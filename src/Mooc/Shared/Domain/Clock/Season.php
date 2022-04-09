<?php

namespace CodelyTv\Mooc\Shared\Domain\Clock;
use Datetime;

abstract class Season
{
    public abstract function start(): ClockInterface;
    public abstract function ends(): ClockInterface;

    protected static function getYear(): int
    {
        return (int)(new Datetime('now'))->format('Y');
    }

    private static function changeYear(Datetime $date, int $year): Datetime
    {
        $yearBase = (int)$date->format('Y');
        $diff = $year - $yearBase;
        return $date->modify("$diff year");
    }

    public function isDateInSeason(ClockInterface $date): bool
    {
        $start = $this->start()->getDate();
        $end = $this->ends()->getDate();
        $currentMonth = (int)$date->getDate()->format('m');
        $changeYear = (int)$start->format('Y') < (int)$end->format('Y');

        // Si estamos en la estación de cambio de año y el mes actual está entre
        // Enero y la final de dicha estación, el año actual será uno más.
        if ($changeYear && $currentMonth >= 1 && $currentMonth <= (int)$end->format('m')) {
            $dateCurrentYear = self::changeYear($date->getDate(), self::getYear() + 1);
        } else {
            $dateCurrentYear = self::changeYear($date->getDate(), self::getYear());
        }

        return $dateCurrentYear >= $start
            && $dateCurrentYear <= $end;
    }
}