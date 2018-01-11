<?php

namespace CodelyTv\Context\Course\Module\Course\Application\Create;

use CodelyTv\Context\Course\Module\Course\Domain\CourseDescription;
use CodelyTv\Context\Course\Module\Course\Domain\CourseTitle;
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
