<?php

namespace CodelyTv\Mooc\Courses\Application\Update;

use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class RenameCourseCommandHandler implements CommandHandler
{
    private CourseRenamer $renamer;

    public function __construct(CourseRenamer $renamer)
    {
        $this->renamer = $renamer;
    }

    public function __invoke(RenameCourseCommand $command)
    {
        $id = new CourseId($command->id());
        $newName = new CourseName($command->newName());

        $this->renamer->__invoke($id, $newName);
    }
}
