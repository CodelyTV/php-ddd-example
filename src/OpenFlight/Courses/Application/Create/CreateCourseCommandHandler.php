<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Courses\Application\Create;

use CodelyTv\OpenFlight\Courses\Domain\CourseDuration;
use CodelyTv\OpenFlight\Courses\Domain\CourseName;
use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class CreateCourseCommandHandler implements CommandHandler
{
    public function __construct(private CourseCreator $creator)
    {
    }

    public function __invoke(CreateCourseCommand $command): void
    {
        $id       = new CourseId($command->id());
        $name     = new CourseName($command->name());
        $duration = new CourseDuration($command->duration());

        $this->creator->__invoke($id, $name, $duration);
    }
}
