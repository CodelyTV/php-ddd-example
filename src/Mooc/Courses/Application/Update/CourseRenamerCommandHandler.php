<?php

namespace CodelyTv\Mooc\Courses\Application\Update;

use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class CourseRenamerCommandHandler implements CommandHandler
{
    private $courseRenamer;

    public function __construct(CourseRenamer $courseRenamer)
    {
        $this->courseRenamer = $courseRenamer;
    }

    public function __invoke(CourseRenamerCommand $command)
    {
        $id       = new CourseId($command->id());
        $name     = new CourseName($command->name());

        $this->courseRenamer->__invoke($id, $name);
    }
}

