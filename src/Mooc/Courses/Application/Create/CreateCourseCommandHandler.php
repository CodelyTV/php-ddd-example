<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Mooc\Shared\Domain\Logger;
use CodelyTv\Mooc\Shared\Infrastructure\EnvironmentVariablesLoggerFactory;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class CreateCourseCommandHandler implements CommandHandler
{
    private CourseCreator $creator;

    public function __construct(CourseCreator $creator)
    {
        $this->creator = $creator;

        $loggerFactory = new EnvironmentVariablesLoggerFactory();
        if ($loggerFactory->filesystemVariablesDefined()) {
            $this->setLogger(
                $loggerFactory->createFilesystemLogger()
            );
        } elseif ($loggerFactory->papertrailVariablesDefined()) {
            $this->setLogger(
                $loggerFactory->createPapertrailLogger()
            );
        }
    }

    /**
     * @param Logger $logger
     */
    public function setLogger(Logger $logger) : void
    {
        $this->creator->setLogger($logger);
    }

    public function __invoke(CreateCourseCommand $command): void
    {
        $id       = new CourseId($command->id());
        $name     = new CourseName($command->name());
        $duration = new CourseDuration($command->duration());

        $this->creator->__invoke($id, $name, $duration);
    }
}
