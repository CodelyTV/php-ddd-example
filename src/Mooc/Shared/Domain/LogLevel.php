<?php


namespace CodelyTv\Mooc\Shared\Domain;


class LogLevel extends \Psr\Log\LogLevel
{
    public static function isStandard($level)
    {
        $logLevels = [
            self::EMERGENCY,
            self::ALERT,
            self::CRITICAL,
            self::ERROR,
            self::WARNING,
            self::NOTICE,
            self::INFO,
            self::DEBUG
        ];

        if(in_array($level, $logLevels))
        {
            return true;
        }

        return false;
    }
}