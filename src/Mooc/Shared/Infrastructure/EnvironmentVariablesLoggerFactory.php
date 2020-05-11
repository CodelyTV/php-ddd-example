<?php

namespace CodelyTv\Mooc\Shared\Infrastructure;

use CodelyTv\Mooc\Shared\Infrastructure\Filesystem\FilesystemLogger;
use CodelyTv\Mooc\Shared\Infrastructure\Papertrail\PapertrailLogger;

class EnvironmentVariablesLoggerFactory
{
    const LOG_FILENAME="LOG_FILENAME";
    const PAPERTRAIL_HOSTNAME="PAPERTRAIL_HOSTNAME";
    const PAPERTRAIL_PORT="PAPERTRAIL_PORT";

    public function createPapertrailLogger() : ?PapertrailLogger
    {
        if(! $this->papertrailVariablesDefined()){
            return null;
        }

        $host = getenv(self::PAPERTRAIL_HOSTNAME);
        $port = (int)getenv(self::PAPERTRAIL_PORT);

        return new PapertrailLogger($host, $port);
    }

    public function createFilesystemLogger(): ?FilesystemLogger
    {
        if( ! $this->filesystemVariablesDefined()){
            return null;
        }

        $folder = "/var/log";
        $filename = getenv(self::LOG_FILENAME);

         return new FilesystemLogger($folder, $filename);

    }

    public function filesystemVariablesDefined() : bool
    {
        return $this->envAreDefined([self::LOG_FILENAME]);
    }

    public function papertrailVariablesDefined() : bool
    {
        return $this->envAreDefined([
            self::PAPERTRAIL_HOSTNAME,
            self::PAPERTRAIL_PORT
        ]);
    }

    /**
     * @param array $variables list of environment variables that we want to check
     * @return bool true if all env variables are defined
     */
    private function envAreDefined(array $variables) : bool
    {
        foreach($variables as $var)
        {
            if(getenv($var) === false)
            {
                return false;
            }
        }
        return true;
    }
}