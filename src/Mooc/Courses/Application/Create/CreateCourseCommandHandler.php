<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Domain\CourseDescription;
use CodelyTv\Mooc\Courses\Domain\CourseTitle;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;

final class CreateCourseCommandHandler
{
    private $creator;

    public function __construct(CourseCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateCourseCommand $command): void
    {
        $id          = new CourseId($command->id());
        $title       = new CourseTitle($command->title());
        $description = new CourseDescription($command->description());

        $this->creator->create($id, $title, $description);
    }
}
