<?php
declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Update;

use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class CourseRenamerCommandHandler implements CommandHandler
{
    private CourseRenamer $courseRenamer;

    public function __construct(CourseRenamer $courseRenamer)
    {
        $this->courseRenamer = $courseRenamer;
    }

    public function __invoke(CourseRenamerCommand $courseRenamerCommand)
    {
        $id      = new CourseId($courseRenamerCommand->getId());
        $newName = new CourseName($courseRenamerCommand->getNewName());

        $this->courseRenamer->__invoke($id, $newName);
    }
}