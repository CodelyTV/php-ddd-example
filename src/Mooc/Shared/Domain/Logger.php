<?php


namespace CodelyTv\Mooc\Shared\Domain;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

abstract class Logger extends AbstractLogger
{
    protected function standardize(string $level, LoggerInterface $logger)
    {
        if(! LogLevel::isStandard($level))
        {
            $logger->log(LogLevel::ERROR, "Incorrect log level ".$level);
            $level = LogLevel::ERROR;
        }

        return $level;
    }
}