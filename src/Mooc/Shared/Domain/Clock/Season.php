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
        $startMonth = (int)$start->format('m');
        $endMonth = (int)$end->format('m');
        $currentMonth = (int)$date->getDate()->format('m');
        $changeYear = $startMonth > (int)$end->format('m');

        if ($changeYear && $currentMonth <= $endMonth && $currentMonth >= 1) {
            $dateCurrentYear = self::changeYear($date->getDate(), self::getYear() + 1);
        } else {
            $dateCurrentYear = self::changeYear($date->getDate(), self::getYear());
        }

        if ($changeYear) {
            $end = self::changeYear($end, $end->format('Y') + 1);
        }
        return $dateCurrentYear >= $start
            && $dateCurrentYear <= $end;
    }
}