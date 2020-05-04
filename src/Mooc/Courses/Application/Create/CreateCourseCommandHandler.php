<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Mooc\Shared\Infrastructure\Filesystem\FilesystemLogger;
use CodelyTv\Mooc\Shared\Infrastructure\Papertrail\PapertrailLogger;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class CreateCourseCommandHandler implements CommandHandler
{
    private CourseCreator $creator;

    const LOG_FILENAME="LOG_FILENAME";
    const PAPERTRAIL_HOSTNAME="PAPERTRAIL_HOSTNAME";
    const PAPERTRAIL_PORT="PAPERTRAIL_PORT";

    public function __construct(CourseCreator $creator)
    {
        $this->creator = $creator;
        $this->initLogger();
    }

    private function initLogger()
    {
        if($this->envAreDefined([self::LOG_FILENAME]))
        {
            $folder = "/var/log";
            $filename = getenv(self::LOG_FILENAME);

            $this->creator->setLogger(new FilesystemLogger($folder, $filename));
        }
        elseif($this->envAreDefined([self::PAPERTRAIL_HOSTNAME, self::PAPERTRAIL_PORT]))
        {
            $host = getenv(self::PAPERTRAIL_HOSTNAME);
            $port = (int)getenv(self::PAPERTRAIL_PORT);

            $this->creator->setLogger(new PapertrailLogger($host, $port));
        }
    }

    /**
     * @param array $variables list of environment variables that we want to check
     * @return bool true if all env variables are defined
     */
    private function envAreDefined(array $variables)
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

    public function __invoke(CreateCourseCommand $command): void
    {
        $id       = new CourseId($command->id());
        $name     = new CourseName($command->name());
        $duration = new CourseDuration($command->duration());

        $this->creator->__invoke($id, $name, $duration);
    }
}
