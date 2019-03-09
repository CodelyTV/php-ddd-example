<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Courses\Application\Create;

use CodelyTv\Backoffice\Courses\Domain\CourseDescription;
use CodelyTv\Backoffice\Courses\Domain\CourseTitle;
use CodelyTv\Shared\Domain\CourseId;

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
